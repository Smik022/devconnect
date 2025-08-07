<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DeveloperController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'Developer');

        if ($request->filled('skills')) {
            $query->where('skills', 'like', '%' . $request->skills . '%');
        }

        if ($request->filled('experience')) {
            $query->where('experience', 'like', '%' . $request->experience . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('availability')) {
            $query->where('availability', $request->availability);
        }

        $developers = $query->get();

        return view('developer.index', compact('developers'));
    }
}








