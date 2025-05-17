<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Support\Facades\DB;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    // Approve an item
    public function approve(Grade $grade)
    {
        $user = Auth::user();

        $existingApproval = $grade->where('teacher1_id', $user->id)->first();

        if ($existingApproval) {
            return back()->with('error', 'You have already approved this item.');
        }

        return back()->with('success', 'Item approved!');
    }

    // Submit the item (only if it's the second approval)
    public function submit(Grade $grade)
    {
        $approvalCount = 0;
        if ($grade->teacher1_id) $approvalCount++;
        if ($grade->teacher2_id) $approvalCount++;

        if ($approvalCount !== 2) {
            return back()->with('error', 'You can only submit once two approvals have been made.');
        }

        $grade->update(['approved' => true]);

        return back()->with('success', 'Item has been submitted!');
    }
}
