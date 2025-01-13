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
    public function index() {
        $categories = Category::all();

        return view('front.index', compact('categories'));
    }

    public function category(Category $category) {
        $categories = Category::all();
        return view('front.jewelry', compact('category', 'categories'));
    }

    public function detail(Category $category, Jewelry $jewelry) {
        $categories = Category::all();
        $jewelry = Jewelry::with('jewelryPhotos')->where('id', $jewelry->id)->get();
        // dd($jewelry);
        return view('front.detail', compact('category', 'categories', 'jewelry'));
    }

    public function checkout(Request $data) {
        // dd(request());
        $categories = Category::all();
        $data->validate([
            'jewelry_id' => 'required|exists:jewelries,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required',
        ]);

        $banks = Bank::all();

        // Mendapatkan nama route sebelumnya
        $previousRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        // dd($previousRoute);

        if ($previousRoute === 'cart.index') {
            $userId = Auth::id();
            $cartItems = Cart::where('user_id', $userId);

            return view('front.cart', compact('cartItems', 'banks', 'categories'));
        } else if ($previousRoute === 'front.detail') {
            $jewelry = Jewelry::findOrFail($data->jewelry_id);

            return view('front.checkout', compact('jewelry', 'data', 'banks', 'categories'));
        } else {
            return redirect('front.index')->withErrors('Opppsss Something Wrong!..');
        }

    }

    public function checkoutProcess(Jewelry $jewelry, Request $request) {
        // dd($request);
        // Validasi data
        $request->validate([
            'jewelry_id' => 'required|exists:jewelries,id',
            'quantity' => 'required|integer|min:1',
            'bank_id' => 'required|exists:banks,id',
        ]);

        $jewelry = Jewelry::where('id', $request->jewelry_id)->firstOrFail();


        $uniqueTrxId = JewelryTransaction::generateUniqueTrxId();
        $sub_total = $jewelry->price * $request['quantity'];

        // Buat transaksi baru
        $transaction = JewelryTransaction::create([
            'user_id' => Auth::id(),
            'jewelry_id' => $request->jewelry_id,
            'quantity' => $request->quantity,
            'sub_total_amount' => $sub_total,
            'grand_total_amount' => $sub_total, // Tambahkan biaya lain jika diperlukan
            'bank_id' => $request->bank_id,
            'is_paid' => false,
            'transaction_trx_id' => $uniqueTrxId,
            'proof' => 'proof.png',
        ]);

        // Redirect ke halaman payment
        return redirect()->route('front.payment', $uniqueTrxId);
    }

    public function payment($uniqueTrxId) {
        // dd(view('front.payment'));
        $transaction = JewelryTransaction::where('transaction_trx_id', $uniqueTrxId)->with('bank')->firstOrFail();

        return view('front.payment', compact('transaction'));

    }

    public function paymentStore($uniqueTrxId, Request $request) {
        $transaction = JewelryTransaction::where('transaction_trx_id', $uniqueTrxId)->firstOrFail();

        $user = Auth::user();
        if ($transaction->user_id != $user->id) {
            abort(403);
        }

        // Validasi file
        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan bukti pembayaran
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filePath = $file->store('proofs', 'public');
            $transaction->update(['proof' => $filePath]);
        }

        return redirect()->route('front.payment', $uniqueTrxId)->with('success', 'Bukti pembayaran berhasil diunggah.');
    }


}
