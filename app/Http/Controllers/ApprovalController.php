<?php

namespace App\Http\Controllers;

use App\Models\Grade;

use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    // Approve an item
    public function approve(Grade $grade)
    {
        $user = Auth::user();

        $existingApproval = $grade->approvals()->where('user_id', $user->id)->first();

        if ($existingApproval) {
            return back()->with('error', 'You have already approved this item.');
        }

        // Create a new approval record
        Approval::create([
            'grade_id' => $grade->id,
            'user_id' => $user->id,
        ]);

        return back()->with('success', 'Item approved!');
    }

    // Submit the item (only if it's the second approval)
    public function submit(Grade $grade)
    {
        // Check the number of approvals
        $approvalCount = $grade->approvals()->count();

        // Ensure there are exactly 2 approvals
        if ($approvalCount !== 2) {
            return back()->with('error', 'You can only submit once two approvals have been made.');
        }

        // Mark the item as submitted (or perform any other action)
        $grade->update(['status' => 'submitted']);

        return back()->with('success', 'Item has been submitted!');
    }
}
