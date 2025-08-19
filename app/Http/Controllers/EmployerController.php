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
                      ->orWhereDate('created_at', $search);
                });
            }
        }

        $employers = $query->paginate(50)
                           ->appends($request->only(['search', 'column']));

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
