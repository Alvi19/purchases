<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        $purchaseRequests = PurchaseRequest::where('status', 'approved')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('finances')
                    ->whereRaw('finances.purchase_request_id = purchase_requests.id');
            })
            ->get();

        return view('finance.index', compact('purchaseRequests'));
    }

    public function approve(Request $request, PurchaseRequest $purchaseRequest)
    {
        $request->validate([
            'transfer_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = $request->file('transfer_proof')->store('transfer_proofs', 'public');

        $purchaseRequest->status = 'approved';
        $purchaseRequest->transfer_proof = $filePath;
        $purchaseRequest->save();

        Finance::create([
            'purchase_request_id' => $purchaseRequest->id,
            'status' => 'approved',
            'transfer_proof' => $filePath,
        ]);

        return redirect()->route('finance.index')->with('success', 'Purchase request approved and transfer proof uploaded successfully.');
    }

    public function reject(Request $request, PurchaseRequest $purchaseRequest)
    {
        $request->validate([
            'reject_reason' => 'required',
        ]);

        $purchaseRequest->status = 'rejected';
        $purchaseRequest->reject_reason = $request->reject_reason;
        $purchaseRequest->save();

        Finance::create([
            'purchase_request_id' => $purchaseRequest->id,
            'status' => 'rejected',
            'reject_reason' => $request->reject_reason,
        ]);

        return redirect()->route('finance.index')->with('success', 'Purchase request rejected successfully.');
    }

    public function history()
    {
        $finances = Finance::where('status', 'approved')->with('purchaseRequest')->get();

        return view('finance.history', compact('finances'));
    }
}
