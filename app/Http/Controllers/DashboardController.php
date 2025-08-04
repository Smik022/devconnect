<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $githubData = null;

        if (!$user) {
            return redirect()->route('login');
        }
        #checks if github link or username then extracts username
        if ($user->role === 'Developer' && $user->github) {
            $username = $this->extractGithubUsername($user->github);

            if ($username) {
                $cacheKey = 'github_user_' . $username;

                $githubData = Cache::remember($cacheKey, 600, function () use ($username) {
                    $response = Http::get("https://api.github.com/users/$username");

                    if ($response->successful()) {
                        return $response->json();
                    }

                    return null;
                });
            }
        }

        if ($user->role === 'Developer') {
            return view('dashboard.developer', compact('user', 'githubData'));
        } elseif ($user->role === 'Employer') {
            return view('dashboard.employer', compact('user'));
        }

        abort(403);
    }

    private function extractGithubUsername($url)
    {
        $url = rtrim($url, '/');
        return basename($url);
    }
}
