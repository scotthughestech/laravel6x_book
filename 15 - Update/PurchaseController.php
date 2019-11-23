<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $purchases = Purchase::orderBy('date', 'desc')->paginate(10);

        // Load the view
        return view('browse', compact('purchases'));
    }

    public function edit(Purchase $purchase)
    {
        return view('edit', compact('purchase'));
    }

    public function update(Request $request, Purchase $purchase)
    {
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
}
