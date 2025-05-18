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

        if ($grade->teacher1_id === $user->id || $grade->teacher2_id === $user->id) {
            return back()->with('error', 'You have already approved this item.');
        }

        if (empty($grade->teacher1_id)) {
            $grade->teacher1_id = $user->id;
        }

        elseif (empty($grade->teacher2_id)) {
            $grade->teacher2_id = $user->id;
        }

        $grade->save();

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
