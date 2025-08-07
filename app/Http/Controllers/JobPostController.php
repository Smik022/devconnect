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
        $jobs = JobPost::latest()->paginate(10);
        return view('jobposts.index', compact('jobs'));
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

}
