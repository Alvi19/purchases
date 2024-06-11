<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $pendingRequests = PurchaseRequest::where('status', 'pending')->get();
        $approvedRequests = PurchaseRequest::where('status', 'approved')->get();

        return view('manager.index', compact('pendingRequests', 'approvedRequests'));
    }

    public function approve(Request $request, PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->status = 'approved';
        $purchaseRequest->save();

        return redirect()->route('manager.index')->with('success', 'Purchase request approved successfully.');
    }

    public function reject(Request $request, PurchaseRequest $purchaseRequest)
    {
        $request->validate([
            'reject_reason' => 'required',
        ]);

        $purchaseRequest->status = 'rejected';
        $purchaseRequest->approval_reason = $request->reject_reason;
        $purchaseRequest->save();

        return redirect()->route('manager.index')->with('success', 'Purchase request rejected successfully.');
    }

    public function history()
    {
        $approvedRequests = PurchaseRequest::where('status', 'approved')->get();

        return view('manager.history', compact('approvedRequests'));
    }
}
