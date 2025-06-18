<?php

namespace App\Http\Policies;

use App\Models\Review;
use App\Models\User;


class ReviewPolicy
{
    /**
     * Determine if the given review can be updated by the user.
     */
    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determine if the given review can be deleted by the user.
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }
}