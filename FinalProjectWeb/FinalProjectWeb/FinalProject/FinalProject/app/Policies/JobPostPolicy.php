<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Jobpost;

class JobPostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Jobpost $jobpost)
    {
        return $user->id === $jobpost->user_id;
    }

    public function delete(User $user, Jobpost $jobpost)
    {
        return $user->id === $jobpost->user_id;
    }
}
