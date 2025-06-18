<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(User $user)
    {
        if (Auth::id() === $user->id) {
            return response()->json([
                'error' => 'Você não pode seguir a si mesmo'
            ], 422);
        }

        Auth::user()->following()->attach($user->id);
        
        return response()->json([
            'message' => 'Agora você segue ' . $user->name
        ], 201);
    }

    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user->id);
        
        return response()->json([
            'message' => 'Você deixou de seguir ' . $user->name
        ]);
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->paginate(15);
        return response()->json($followers);
    }

    public function following(User $user)
    {
        $following = $user->following()->paginate(15);
        return response()->json($following);
    }
}