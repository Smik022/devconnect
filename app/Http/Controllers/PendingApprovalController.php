<?php

namespace App\Http\Controllers;

use App\Models\PendingApproval;
use Illuminate\Http\Request;

class PendingApprovalController extends Controller
{    
    public function index(Request $request)
    {
    $query = PendingApproval::query();

    if ($search = $request->input('search')) {
        $column = $request->input('column');

        if ($column === 'created_at') {
            $search = trim($search);

            if (str_contains($search, 'to')) {
                [$start, $end] = array_map('trim', explode('to', $search));
                $query->whereBetween('created_at', [
                    $start . ' 00:00:00',
                    $end . ' 23:59:59'
                ]);
            } elseif (preg_match('/^\d{4}-\d{2}$/', $search)) {
                $query->whereYear('created_at', substr($search, 0, 4))
                      ->whereMonth('created_at', substr($search, 5, 2));
            } elseif (preg_match('/^\d{4}$/', $search)) {
                $query->whereYear('created_at', $search);
            } else {
                $query->whereDate('created_at', $search);
            }
        } else {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('salary', 'like', "%{$search}%")
                  ->orWhere('job_type', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhereDate('created_at', $search);
            });
        }
    }

    $pendingApprovals = $query->paginate(50)
                              ->appends($request->only(['search'])); 
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
