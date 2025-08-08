<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class EmployerSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = JobPost::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        if ($request->has('company') && !empty($request->input('company'))) {
            $query->where('company_name', 'like', '%' . $request->input('company') . '%');
        }

        $jobPosts = $query->with('user')->get();
        return view('employer.search', compact('jobPosts'));
    }
}