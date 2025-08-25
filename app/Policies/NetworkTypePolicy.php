<?php

namespace App\Policies;

use App\Models\User;
use App\Models\NetworkType;
use Illuminate\Auth\Access\HandlesAuthorization;

class NetworkTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_network::type');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NetworkType $networkType): bool
    {
        return $user->can('view_network::type');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_network::type');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NetworkType $networkType): bool
    {
        return $user->can('update_network::type');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NetworkType $networkType): bool
    {
        return $user->can('delete_network::type');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_network::type');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, NetworkType $networkType): bool
    {
        return $user->can('force_delete_network::type');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_network::type');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, NetworkType $networkType): bool
    {
        return $user->can('restore_network::type');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_network::type');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, NetworkType $networkType): bool
    {
        return $user->can('replicate_network::type');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_network::type');
    }
}
