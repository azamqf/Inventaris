<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gun;
use Illuminate\Auth\Access\HandlesAuthorization;

class GunPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_gun');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gun $gun): bool
    {
        if ($user->can('view_any_gun')) {
            return true;
        }
        if ($user->can('view_own_gun')) {
            // Asumsi Gun punya relasi member->user_id (jika tidak, sesuaikan field relasi)
            return $gun->member && $gun->member->user_id === $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_gun');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gun $gun): bool
    {
        return $user->can('update_gun');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gun $gun): bool
    {
        return $user->can('delete_gun');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_gun');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Gun $gun): bool
    {
        return $user->can('force_delete_gun');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_gun');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Gun $gun): bool
    {
        return $user->can('restore_gun');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_gun');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Gun $gun): bool
    {
        return $user->can('replicate_gun');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_gun');
    }
}
