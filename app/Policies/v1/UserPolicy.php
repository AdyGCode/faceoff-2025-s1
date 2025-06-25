<?php

namespace App\Policies\v1;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     * Only Super Admin and Admin can view all users.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperuserOrAdmin();
    }

    /**
     * Determine whether the user can view the specific model
     * Super Admin, Admin, or the user themselves can view a specific profile.
     */
    public function view(User $loggedInUser, User $targetUser): bool
    {
        return $loggedInUser->isSuperuserOrAdmin() || $loggedInUser->id === $targetUser->id;
    }

    /**
     * Determine whether the user can create models.
     * Only Super Admin and Admin can create users.
     */
    public function create(User $user): bool
    {
        return $user->isSuperuserOrAdmin();
    }

    /**
     * Determine whether the user can update the model.
     * Super Admin, Admin, or the user themselves can update a profile.
     */
    public function update(User $loggedInUser, User $targetUser): bool
    {
        return $loggedInUser->isSuperuserOrAdmin() || $loggedInUser->id === $targetUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     * Super Admin, Admin, or the user themselves can delete a profile.
     */
    public function delete(User $loggedInUser, User $targetUser): bool
    {
        return $loggedInUser->isSuperuserOrAdmin() || $loggedInUser->id === $targetUser->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
