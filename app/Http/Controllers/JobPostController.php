<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendingApproval;

class JobPostController extends Controller
{
    public function index()
    {
        $jobs = JobPost::with(['user', 'wishlists'])->latest()->paginate(10);
        return view('jobposts.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = JobPost::with('user')->findOrFail($id);
        $user = auth()->user();
        
        if ($user) {
            $hasApplied = $job->applications()->where('user_id', $user->id)->exists();
            $isWishlisted = $user->wishlists()->where('job_post_id', $id)->exists();
        } else {
            $hasApplied = false;
            $isWishlisted = false;
        }
        
        return view('jobposts.show', compact('job', 'hasApplied', 'isWishlisted'));
    }

    public function create()
    {
        $categories = [
            'Web Development',
            'Mobile Development',
            'DevOps',
            'AI',
            'Machine Learning',
            'Data Science',
            'UI/UX Design',
            'Cyber Security',
            'Cloud Computing',
            'Blockchain',
            'Game Development',
            'Embedded Systems',
            'QA / Testing',
            'Technical Writing',
            'Product Management'
        ];

        return view('jobposts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'salary' => 'required',
            'job_type' => 'required|in:Remote,Hybrid,Onsite',
            'location' => 'required',
            'company_name' => 'required',
        ]);

        PendingApproval::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'salary' => $request->salary,
            'job_type' => $request->job_type,
            'location' => $request->location,
            'company_name' => $request->company_name,
        ]);

        return redirect()->route('jobposts.index')->with('success', 'Job submitted for approval!');
    }   
    
    //APURBO
    public function approve($id)
    {
        $pending = PendingApproval::findOrFail($id);

        JobPost::create([
            'user_id'      => $pending->user_id,       
            'title'        => $pending->title,
            'description'  => $pending->description,
            'category'     => $pending->category,
            'salary'       => $pending->salary,
            'job_type'     => $pending->job_type,
            'location'     => $pending->location,
            'company_name' => $pending->company_name,
        ]);

        $pending->delete();

        return response()->json(['message' => 'Job posting approved successfully.']);
    }    
    
    public function job_index(Request $request)
    {
        $query = JobPost::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $validSorts = ['title', 'description', 'category', 'salary', 'job_type', 'location', 'company_name', 'created_at'];
        $sort = $request->input('sort', 'title');
        $sort = in_array($sort, $validSorts) ? $sort : 'title';

        $direction = $request->input('direction', 'asc');
        $direction = in_array(strtolower($direction), ['asc', 'desc']) ? $direction : 'asc';

        $job_posts = $query->orderBy($sort, $direction)
        ->paginate(50)
        ->appends($request->only(['search', 'sort', 'direction']));

        return view('/admin/job_postings', compact('job_posts'));
    }

    public function update(Request $request, JobPost $job_posting)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'category'     => 'required|string|max:255',
            'salary'       => 'required|numeric',
            'job_type'     => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
        ], [
            'title.required'        => 'Title required.',
            'description.required'  => 'Description required.',
            'category.required'     => 'Category required.',
            'salary.required'       => 'Salary required.',
            'job_type.required'     => 'Job type required.',
            'location.required'     => 'Location required.',
            'company_name.required' => 'Company name required.',
        ]);

        $job_posting->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Job posting updated successfully.',
            ]);
        }

        return redirect()
        ->route('job_postings')
        ->with('success', 'Job posting updated successfully.');
    }

    public function destroy(JobPost $job_posting)
    {
        $job_posting->delete();
        return response()->json(['message' => 'Job posting deleted successfully']);
    }
}
