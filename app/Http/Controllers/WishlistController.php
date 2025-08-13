<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with('jobPost.user')->get();
        return view('developer.wishlist', compact('wishlists'));
    }

    public function toggle($jobId)
    {
        $user = Auth::user();
        $existingWishlist = Wishlist::where('user_id', $user->id)
            ->where('job_post_id', $jobId)
            ->first();

        if ($existingWishlist) {
            $existingWishlist->delete();
            return response()->json(['message' => 'Removed from wishlist', 'action' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'job_post_id' => $jobId
            ]);
            return response()->json(['message' => 'Added to wishlist', 'action' => 'added']);
        }
    }

    public function check($jobId)
    {
        $user = Auth::user();
        $isWishlisted = Wishlist::where('user_id', $user->id)
            ->where('job_post_id', $jobId)
            ->exists();

        return response()->json(['isWishlisted' => $isWishlisted]);
    }
}

