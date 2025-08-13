<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'Employer');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $validSorts = [
            'name', 'email', 'role', 'bio', 'skills', 'experience',
            'education', 'github', 'stackoverflow', 'portfolio',
            'resume', 'created_at', 'updated_at'
        ];

        $sort = in_array($request->input('sort'), $validSorts) ? $request->input('sort') : 'name';
        $direction = $request->input('direction') === 'desc' ? 'desc' : 'asc';

        $employers = $query->orderBy($sort, $direction)
        ->paginate(50)
        ->appends($request->only(['search', 'sort', 'direction']));

        return view('admin.employers', compact('employers'));

    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email is already taken.',
        ]);

        $user->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.'
            ]);
        }

        return redirect()
            ->route('admin_employers')
            ->with('success', 'User updated successfully.');
    }


        public function destroy(User $employer)
        {
            $employer->delete();
            return response()->json(['message' => 'Employer deleted successfully']);
        }
    }
