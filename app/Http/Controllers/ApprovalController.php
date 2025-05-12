<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    // Approve an item
    public function approve(Item $item)
    {
        $user = Auth::user();

        // Check if the user has already approved the item
        $existingApproval = $item->approvals()->where('user_id', $user->id)->first();

        if ($existingApproval) {
            return back()->with('error', 'You have already approved this item.');
        }

        // Create a new approval record
        Approval::create([
            'item_id' => $item->id,
            'user_id' => $user->id,
        ]);

        return back()->with('success', 'Item approved!');
    }

    // Submit the item (only if it's the second approval)
    public function submit(Item $item)
    {
        // Check the number of approvals
        $approvalCount = $item->approvals()->count();

        // Ensure there are exactly 2 approvals
        if ($approvalCount !== 2) {
            return back()->with('error', 'You can only submit once two approvals have been made.');
        }

        // Mark the item as submitted (or perform any other action)
        $item->update(['status' => 'submitted']);

        return back()->with('success', 'Item has been submitted!');
    }
}
