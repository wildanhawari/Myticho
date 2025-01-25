<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Cart;
use App\Models\Jewelry;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\JewelryTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('front.index', compact('categories'));
    }

    public function category(Category $category)
    {
        $categories = Category::all();
        return view('front.jewelry', compact('category', 'categories'));
    }

    public function detail(Category $category, Jewelry $jewelry)
    {
        $categories = Category::all();
        $jewelry = Jewelry::with('jewelryPhotos')->where('id', $jewelry->id)->get();
        return view('front.detail', compact('category', 'categories', 'jewelry'));
    }

    public function checkout(Request $data)
    {
        $data->validate([
            'jewelry_id' => 'required|exists:jewelries,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required',
        ]);
        $categories = Category::all();
        $banks = Bank::all();
        $jewelry = Jewelry::findOrFail($data->jewelry_id);

        return view('front.checkout', compact('jewelry', 'data', 'banks', 'categories'));
    }

    public function cartCheckout()
    {
        $categories = Category::all();
        $banks = Bank::all();
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        return view('front.cartCheckout', compact('cartItems', 'banks', 'categories'));
    }

    public function checkoutProcess(Jewelry $jewelry, Request $request)
    {
        $request->validate([
            'jewelry_id' => 'required|exists:jewelries,id',
            'quantity' => 'required|integer|min:1',
            'bank_id' => 'required|exists:banks,id',
        ]);

        $jewelry = Jewelry::where('id', $request->jewelry_id)->firstOrFail();

        $uniqueTrxId = JewelryTransaction::generateUniqueTrxId();
        $sub_total = $jewelry->price * $request['quantity'];

        // Create new transaction
        $transaction = JewelryTransaction::create([
            'user_id' => Auth::id(),
            'jewelry_id' => $request->jewelry_id,
            'quantity' => $request->quantity,
            'sub_total_amount' => $sub_total,
            'grand_total_amount' => $sub_total,
            'bank_id' => $request->bank_id,
            'is_paid' => false,
            'transaction_trx_id' => $uniqueTrxId,
            'proof' => 'proof.png',
            'status' => 'unpaid',
        ]);

        return redirect()->route('front.payment', $uniqueTrxId);
    }

    public function cartCheckoutProcess(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('front.cart')->withErrors('Your cart is empty!');
        }

        $grandTotal = 0;
        foreach ($cartItems as $item) {
            $grandTotal += $item->jewelry->price * $item->quantity;
        }

        $uniqueTrxId = JewelryTransaction::generateUniqueTrxId();

        $transaction = JewelryTransaction::create([
            'user_id' => $user->id,
            'sub_total_amount' => $grandTotal,
            'grand_total_amount' => $grandTotal,
            'bank_id' => $request->bank_id,
            'is_paid' => false,
            'transaction_trx_id' => $uniqueTrxId,
            'proof' => 'proof.png',
            'status' => 'unpaid',
        ]);

        foreach ($cartItems as $item) {
            $transaction->items()->create([
                'jewelry_id' => $item->jewelry_id,
                'quantity' => $item->quantity,
                'sub_total_amount' => $item->jewelry->price * $item->quantity,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('front.payment', $uniqueTrxId);
    }

    public function payment($uniqueTrxId)
    {
        $transaction = JewelryTransaction::where('transaction_trx_id', $uniqueTrxId)->with('bank')->firstOrFail();

        return view('front.payment', compact('transaction'));
    }

    public function paymentStore($uniqueTrxId, Request $request)
    {
        $transaction = JewelryTransaction::where('transaction_trx_id', $uniqueTrxId)->firstOrFail();

        $user = Auth::user();
        if ($transaction->user_id != $user->id) {
            abort(403);
        }

        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filePath = $file->store('proofs', 'public');
            $transaction->update(['proof' => $filePath]);
            $transaction->update(['is_paid' => false, 'status' => 'checking']); // Set the status to "in delivery" after payment is received
        }

        return redirect()->route('front.paymentSuccess', $uniqueTrxId);
    }

    public function paymentSuccess()
    {
        return view('front.paymentSuccess');
    }
}
