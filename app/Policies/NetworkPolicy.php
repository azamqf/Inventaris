<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Network;
use Illuminate\Auth\Access\HandlesAuthorization;

class NetworkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_network');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Network $network): bool
    {
        if ($user->can('view_any_network')) {
            return true;
        }
        if ($user->can('view_own_network')) {
            // Asumsi Network punya relasi member->user_id
            return $network->member && $network->member->user_id === $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_network');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Network $network): bool
    {
        return $user->can('update_network');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Network $network): bool
    {
        return $user->can('delete_network');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_network');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Network $network): bool
    {
        return $user->can('force_delete_network');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_network');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Network $network): bool
    {
        return $user->can('restore_network');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_network');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Network $network): bool
    {
        return $user->can('replicate_network');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_network');
    }
}
