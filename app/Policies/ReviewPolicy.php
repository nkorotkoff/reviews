<?php

namespace App\Policies;

use App\Models\review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, review $review)
    {

        return $user->id === $review->author_id
            ? Response::allow()
            : Response::deny('You do not own this review.');
    }
}
