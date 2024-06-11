<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index()
    {
        $purchase = PurchaseRequest::orderBy('created_at', 'desc')->get();

        return view('officer.index', compact('purchase'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        PurchaseRequest::create([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('officer.index')->with('success', 'Data berhasil ditambah.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $purchase = PurchaseRequest::findOrFail($id);

        $purchase->update([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('officer.index')->with('success', 'Data Berhasil diupdate');
    }

    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->delete();

        return redirect()->route('officer.index')->with('success', 'Data Berhasil dihapus.');
    }
}
