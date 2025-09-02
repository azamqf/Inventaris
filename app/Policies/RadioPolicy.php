<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Radio;
use Illuminate\Auth\Access\HandlesAuthorization;

class RadioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_radio');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Radio $radio): bool
    {
        if ($user->can('view_any_radio')) {
            return true;
        }
        if ($user->can('view_own_radio')) {
            // Asumsi Radio punya relasi member->user_id
            return $radio->member && $radio->member->user_id === $user->id;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_radio');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Radio $radio): bool
    {
        if ($user->hasRole('super_admin')) {
            return $user->can('update_radio'); // Original code, bawaan dari Filament-Shield
        } else if ($user->id === $radio->member->user_id) {
            return $user->can('update_radio');
        }

        return false;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Radio $radio): bool
    {
        if ($user->hasRole('super_admin')) {
            return $user->can('delete_radio'); // Original code, bawaan dari Filament-Shield
        }

        if ($user->id === $radio->member->user_id) {
            return $user->can('delete_radio');
        }

        return false;
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_radio');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Radio $radio): bool
    {
        if ($user->hasRole('super_admin')) {
            return $user->can('force_delete_radio'); // Original code, bawaan dari Filament-Shield
        }

        if ($user->id === $radio->member->user_id) {
            return $user->can('force_delete_radio');
        }

        return false;
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_radio');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Radio $radio): bool
    {
        if ($user->hasRole('super_admin')) {
            return $user->can('restore_radio'); // Original code, bawaan dari Filament-Shield
        }

        if ($user->id === $radio->member->user_id) {
            return $user->can('restore_radio');
        }

        return false;

    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_radio');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Radio $radio): bool
    {
        if ($user->hasRole('super_admin')) {
            return $user->can('replicate_radio'); // Original code, bawaan dari Filament-Shield
        }

        if ($user->id === $radio->member->user_id) {
            return $user->can('replicate_radio');
        }

        return false;

    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_radio');
    }
}
