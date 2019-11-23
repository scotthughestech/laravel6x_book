<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Purchase;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Validate the data
        $request->validate([
            'date' => 'required|date',
            'price' => 'required|numeric|min:0.01|max:99999999999.99',
            'description' => 'required|max:255'
        ]);

        // Set up new purchase
        $purchase = new Purchase;
        $purchase->user_id = Auth::id();
        $purchase->date = $request->date;
        $purchase->price = $request->price;
        $purchase->description = $request->description;
        $purchase->save();

        // Set status message and redirect back to the form
        $request->session()->flash('status', 'Purchase saved');
        return back();
    }

    public function browse()
    {
        // Load purchases
        $purchases = Auth::user()
            ->purchases()
            ->orderBy('date', 'desc')
            ->paginate(10);

        // Load the view
        return view('browse', compact('purchases'));
    }

    public function edit(Purchase $purchase)
    {
        // Make sure the user owns this purchase
        if (Auth::id() != $purchase->user_id) {
            return response('Forbidden', 403);
        }

        return view('edit', compact('purchase'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        // Make sure the user owns this purchase
        if (Auth::id() != $purchase->user_id) {
            return response('Forbidden', 403);
        }

        // Validate the data
        $request->validate([
            'date' => 'required|date',
            'price' => 'required|numeric|min:0.01|max:99999999999.99',
            'description' => 'required|max:255'
        ]);

        // Assign request data to purchase
        $purchase->date = $request->date;
        $purchase->price = $request->price;
        $purchase->description = $request->description;

        // Save the updated purchase to the database
        $purchase->save();

        // Set status message and redirect back to the form
        $request->session()->flash('status', 'Purchase updated');
        return back();
    }

    public function delete(Purchase $purchase)
    {
        // Make sure the user owns this purchase
        if (Auth::id() != $purchase->user_id) {
            return response('Forbidden', 403);
        }

        // Delete purchase
        $purchase->delete();

        // Redirect back to the browse page
        return back();
    }
}
