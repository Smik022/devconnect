<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Check if user already applied
        $existingApplication = JobApplication::where('user_id', Auth::id())
            ->where('job_post_id', $jobId)
            ->first();

        if ($existingApplication) {
            return redirect()->route('jobposts.show', $jobId)
                ->with('error', 'You have already applied for this job.');
        }

        JobApplication::create([
            'job_post_id' => $jobId,
            'user_id' => Auth::id(),
            'proposal' => $request->proposal,
            'status' => 'pending'
        ]);

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
        
        // Check if the user owns the job post
        if ($application->jobPost->user_id !== Auth::id()) {
            abort(403);
        }

        $application->update(['status' => $request->status]);

        return response()->json(['message' => 'Application status updated successfully']);
    }
}

