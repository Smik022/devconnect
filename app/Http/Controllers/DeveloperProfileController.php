<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;

class DeveloperProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        if ($user->role !== 'Developer') {
            abort(403, 'Access denied');
        }

        return view('developer.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'Developer') {
            abort(403, 'Access denied');
        }

        $validated = $request->validate([
            'bio' => 'nullable|string|max:2000',
            'skills' => 'nullable|string|max:2000',
            'experience' => 'nullable|string|max:2000',
            'education' => 'nullable|string|max:2000',
            'github' => 'nullable|string|max:255',        // username only here
            'stackoverflow' => 'nullable|string|max:255',
            'portfolio' => 'nullable|string|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Extract GitHub username only (strip URL if full URL entered)
        $githubInput = $validated['github'] ?? null;
        if ($githubInput) {
            // If user entered full URL, extract username part
            if (Str::startsWith($githubInput, ['http://', 'https://'])) {
                $parsed = parse_url($githubInput);
                $path = $parsed['path'] ?? '';
                $githubUsername = trim($path, '/');
                // In case user put full URL with extra slashes or params, just get first segment
                $githubUsername = explode('/', $githubUsername)[0];
            } else {
                // Otherwise assume they entered username only
                $githubUsername = trim($githubInput);
            }
        } else {
            $githubUsername = null;
        }

        // Normalize StackOverflow URL same as before
        $stackoverflow = $validated['stackoverflow'] ?? null;
        if ($stackoverflow && !Str::startsWith($stackoverflow, 'http')) {
            $stackoverflow = 'https://stackoverflow.com/users/' . ltrim($stackoverflow, '/');
        }

        // Normalize Portfolio URL same as before
        $portfolio = $validated['portfolio'] ?? null;
        if ($portfolio && !Str::startsWith($portfolio, 'http')) {
            $portfolio = 'https://' . ltrim($portfolio, '/');
        }

        $user->bio = $validated['bio'] ?? null;
        $user->skills = $validated['skills'] ?? null;
        $user->experience = $validated['experience'] ?? null;
        $user->education = $validated['education'] ?? null;
        $user->github = $githubUsername;
        $user->stackoverflow = $stackoverflow;
        $user->portfolio = $portfolio;

        if ($request->hasFile('resume')) {
            if ($user->resume) {
                Storage::delete('public/resumes/' . $user->resume);
            }

            $file = $request->file('resume');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName) . '.' . $extension;

            $file->storeAs('public/resumes', $filename);
            $user->resume = $filename;
        }

        $user->save();

        return redirect()->route('developer.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
