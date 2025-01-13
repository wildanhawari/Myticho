<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Jewelry;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index() {
        $categories = Category::all();
        $cartItems = Cart::where('user_id', Auth::id())->with('jewelry')->get();
        // $latestPhotos = $packageTour->package_photos()->orderByDesc('id')->take(3)->get();
        // $cartItems = $cart->jewelries()->orderByDesc('id')->get();
        // sweet alert confirmation
        // $title = 'Delete Jewelry!';
        // $text = "Are you sure you want to delete?";
        // confirmDelete($title, $text);

        return view('front.cart', compact('categories', 'cartItems'));
    }

    public function cartAdd(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'jewelry_id' => 'required|exists:jewelries,id', // Pastikan jewelry_id ada di tabel jewelries
            'quantity' => 'required|integer|min:1',        // Pastikan quantity adalah integer dan lebih dari 0
        ]);

        // Mulai transaksi untuk memastikan integritas data
        DB::transaction(function () use ($request) {
            $userId = Auth::id(); // Ambil ID user yang sedang login
            $jewelryId = $request->jewelry_id;
            $quantity = $request->quantity;

            // Ambil data perhiasan untuk menghitung harga
            $jewelry = Jewelry::findOrFail($jewelryId);

            // Cari item di keranjang user saat ini
            $cartItem = Cart::where('user_id', $userId)
                            ->where('jewelry_id', $jewelryId)
                            ->first();

            if ($cartItem) {
                // Jika item sudah ada, tambahkan quantity
                $cartItem->quantity += $quantity;
                $cartItem->total_price = $cartItem->quantity * $jewelry->price;
                // Hitung grand total untuk semua item di keranjang user
                $grandTotalPrice = Cart::where('user_id', $userId)
                ->sum('total_price');

                $cartItem->save();
            } else {
                // Jika item belum ada, buat data baru
                Cart::create([
                    'user_id' => $userId,
                    'jewelry_id' => $jewelryId,
                    'quantity' => $quantity,
                    'total_price' => $jewelry->price * $quantity,
                    'grand_total_price' => $jewelry->price * $quantity,
                ]);
            }
        });

        toast()
        ->success('Success! Your Dream Jewelry Awaits 💎', 'Head over to your cart and make it yours today!');
        return redirect()->back();
    }
}
