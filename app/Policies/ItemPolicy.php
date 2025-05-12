<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use App\Models\Approval;
use Illuminate\Auth\Access\Response;

class ItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Item $item): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Item $item): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Item $item): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Item $item): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Item $item): bool
    {
        return false;
    }

    public function submit(User $user, Item $item): bool
    {
        // Get the approvals for the item
        $approvals = $item->approvals;

        // Check if the user has already approved
        if ($approvals->contains('user_id', $user->id)) {
            return false; // Can't submit if they've already approved
        }

        // Only allow submission if there's exactly 1 approval (second approval)
        return $approvals->count() === 1;
    }
}
