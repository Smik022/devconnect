<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class AdminPanelController extends Controller
{
    public function index()
    {
        $totalDevelopers = DB::table('users')->where('role', 'Developer')->count();
        $totalEmployers = DB::table('users')->where('role', 'Employer')->count();
        $totalJobs = DB::table('job_posts')->count();
        $pendingCount = DB::table('pending_approvals')->count();

        $dates = collect(range(0, 6))->map(function ($i) {
            return Carbon::today()->subDays(6 - $i)->format('Y-m-d');
        });

        $jobPostsPerDay = DB::table('job_posts')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()->endOfDay()])
            ->groupBy('date')
            ->pluck('count', 'date');

        $pendingPerDay = DB::table('pending_approvals')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()->endOfDay()])
            ->groupBy('date')
            ->pluck('count', 'date');

        $employersPerDay = DB::table('users')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('role', 'Employer')
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()->endOfDay()])
            ->groupBy('date')
            ->pluck('count', 'date');

        $developersPerDay = DB::table('users')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('role', 'Developer')
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()->endOfDay()])
            ->groupBy('date')
            ->pluck('count', 'date');

        $jobData = [];
        $pendingData = [];
        $employersData = [];
        $developersData = [];
        $labels = [];

        foreach ($dates as $date) {
            $labels[] = Carbon::parse($date)->format('M d');
            $jobData[] = $jobPostsPerDay[$date] ?? 0;
            $pendingData[] = $pendingPerDay[$date] ?? 0;
            $employersData[] = $employersPerDay[$date] ?? 0;
            $developersData[] = $developersPerDay[$date] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalDevelopers',
            'totalEmployers',
            'totalJobs',
            'pendingCount',
            'labels',
            'jobData',
            'pendingData',
            'employersData',
            'developersData'
        ));
    }

 
    public function search(Request $request)
    {
        $query = strtolower(trim($request->input('q')));
        $routes = [
            'dashboard' => route('admin_dashboard'),
            'profile' => route('admin_profile'),
            //'help' => route('admin_help'),
            //'developers' => route('admin_developers'),
            //'employers' => route('admin_employers'),
            'postings' => route('job_postings'),
            'pending' => route('pending_approvals'),
            //'messages' => route('admin_messages'),
        ];

        foreach ($routes as $keyword => $url) {
            if (strpos($query, $keyword) !== false) {
                return redirect($url);
            }
        }
        return redirect()->back()->with('searchError', 'No results found');
    }    
    
    public function profile()
    {
        $admin = auth('admin')->user(); 
        return view('admin.profile', compact('admin'));
    }  
    
    public function updateProfile(Request $request)
    {
        $admin = auth('admin')->user(); 

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin,email,' . $admin->id,
            'phone' => 'nullable|string|max:20|regex:/^\+?[0-9]{7,20}$/',
            'is_super' => 'sometimes|boolean',
        ]);

        try {
            $admin->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'is_super' => $request->has('is_super') ? 1 : 0,
            ]);

            return redirect()->route('admin_profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin_profile')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
