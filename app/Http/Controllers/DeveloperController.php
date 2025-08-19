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

    //APURBO
    public function dev_index(Request $request)
    {
        $query = User::where('role', 'Developer');

        if ($search = $request->input('search')) {
            $column = $request->input('column');

            if ($column === 'created_at') {
                $search = trim($search);

                if (str_contains(strtolower($search), 'to')) {
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
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('bio', 'like', "%{$search}%")
                      ->orWhere('skills', 'like', "%{$search}%")
                      ->orWhere('experience', 'like', "%{$search}%")
                      ->orWhere('education', 'like', "%{$search}%")
                      ->orWhere('github', 'like', "%{$search}%")
                      ->orWhere('stackoverflow', 'like', "%{$search}%")
                      ->orWhere('portfolio', 'like', "%{$search}%")
                      ->orWhere('resume', 'like', "%{$search}%")
                      ->orWhereDate('created_at', $search);
                });
            }
        }

        $developers = $query->paginate(50)
                            ->appends($request->only(['search', 'column']));

        return view('admin.developers', compact('developers'));

    }  
    
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'github' => 'nullable|url|max:255',
            'stackoverflow' => 'nullable|url|max:255',
            'portfolio' => 'nullable|url|max:255',
            'resume' => 'nullable|url|max:255',
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email is already taken.',
            'github.url' => 'The GitHub field must be a valid URL.',
            'stackoverflow.url' => 'The StackOverflow field must be a valid URL.',
            'portfolio.url' => 'The Portfolio field must be a valid URL.',
            'resume.url' => 'The Resume field must be a valid URL.',
        ]);

        $user->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Developer updated successfully.'
            ]);
        }

        return redirect()
            ->route('admin_developers')
            ->with('success', 'Developer updated successfully.');
    }
    
    public function destroy(User $developer)
    {
        $developer->delete();
        return response()->json(['message' => 'Developer deleted successfully']);
    }    
}
