<?php

namespace App\Http\Controllers;

use App\Models\PendingApproval;
use Illuminate\Http\Request;

class PendingApprovalController extends Controller
{
    
    public function index(Request $request)
    {
        $allowedSorts = ['title', 'description', 'category', 'salary', 'job_type', 'location', 'company_name', 'created_at'];
        $sort = $request->input('sort', 'title');
        $direction = $request->input('direction', 'asc');

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'title';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $query = PendingApproval::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('job_type', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('salary', 'like', "%{$search}%");                  
            });
        }

        $query->orderBy($sort, $direction);

        $pendingApprovals = $query->get();

        return view('admin.pending_approvals', compact('pendingApprovals'));
    }

    
    public function destroy(PendingApproval $pendingApproval)
    {
        $pendingApproval->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Pending approval deleted successfully.']);
        }

        return redirect()->route('pending_approvals')->with('success', 'Pending approval deleted successfully.');
    }
}
