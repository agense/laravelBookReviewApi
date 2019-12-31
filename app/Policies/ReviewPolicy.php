<?php

namespace App\Policies;

use App\User;
use App\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the review.
     * Authorizes review authors to update their own reviews
     * @param  \App\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function update(User $user, Review $review)
    {
        return $user->id == $review->user_id;
    }

    /**
     * Determine whether the user can delete the review.
     * Authorizes review authors to delete their own reviews and admins to delete any review
     * @param  \App\User  $user
     * @param  \App\Review  $review
     * @return mixed
     */
    public function delete(User $user, Review $review)
    {
        if($user->role=="admin" || $user->id == $review->user_id){
            return true;
        }
        return false;
    }

}
