<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewJobApplication; // <-- keep this

class JobApplicationController extends Controller
{
    public function apply($jobId)
    {
        $job = JobPost::findOrFail($jobId);
        return view('jobposts.apply', compact('job'));
    }

    public function store(Request $request, $jobId)
    {
        $request->validate([
            'proposal' => 'required|string|min:10'
        ]);

        $job = JobPost::findOrFail($jobId);

        // Stop duplicates: same user already applied to this job
        $existingApplication = JobApplication::where('user_id', Auth::id())
            ->where('job_post_id', $jobId)
            ->first();

        if ($existingApplication) {
            return redirect()->route('jobposts.show', $jobId)
                ->with('error', 'You have already applied for this job.');
        }

        // Create the application (unchanged behavior, but store the model in a variable)
        $application = JobApplication::create([
            'job_post_id' => $jobId,
            'user_id'     => Auth::id(),
            'proposal'    => $request->proposal,
            'status'      => 'pending',
        ]);

        // 🔔 NEW: notify the employer who posted this job
        // Assumes JobPost has: public function user() { return $this->belongsTo(User::class); }
        $employer = $job->user ?? null;
        if ($employer && $employer->id !== Auth::id()) { // don’t notify self if employer applies to own job
            $employer->notify(new NewJobApplication($job, $application));
        }

        return redirect()->route('jobposts.show', $jobId)
            ->with('success', 'Your application has been submitted successfully!');
    }

    public function employerApplications()
    {
        $user = Auth::user();
        $jobPosts = $user->jobPosts()->with(['applications.user'])->get();

        return view('employer.applications', compact('jobPosts'));
    }

    public function updateStatus(Request $request, $applicationId)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected,shortlisted'
        ]);

        $application = JobApplication::findOrFail($applicationId);

        // Only the owner of the job post may change status
        if ($application->jobPost->user_id !== Auth::id()) {
            abort(403);
        }

        $application->update(['status' => $request->status]);

        return response()->json(['message' => 'Application status updated successfully']);
    }
}
