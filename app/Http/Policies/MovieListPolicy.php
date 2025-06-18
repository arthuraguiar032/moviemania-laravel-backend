<?php

namespace App\Http\Policies;

use App\Models\MovieList;
use App\Models\User;


class MovieListPolicy
{
    /**
     * Determine whether the user can view any movie lists.
     */
    public function viewAny(User $user): bool
    {
        return true; // Allow all authenticated users to view movie lists
    }

    /**
     * Determine whether the user can view the movie list.
     */
    public function view(User $user, MovieList $movieList): bool
    {
        return $user->id === $movieList->user_id || $movieList->is_public; // Allow viewing if the user is the owner or if the list is public
    }

    /**
     * Determine whether the user can update the movie list.
     */
    public function update(User $user, MovieList $movieList): bool
    {
        return $user->id === $movieList->user_id; // Only allow the owner to update their own movie list
    }

    /**
     * Determine whether the user can delete the movie list.
     */
    public function delete(User $user, MovieList $movieList): bool
    {
        return $user->id === $movieList->user_id; // Only allow the owner to delete their own movie list
    }
}