<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use App\Models\JewelryTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Show the edit profile form
    public function edit()
    {
        $user = Auth::user();
        $transactions = JewelryTransaction::where('user_id', $user->id)->orderByDesc('created_at')->get();
        return view('front.profile', compact('user', 'transactions'));
    }

    public function setting() {
        $categories = Category::all();
        return view('front.setting', compact('categories', ));
    }

    // Update the user's profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function transactions() {
        $transactions = JewelryTransaction::where('user_id', Auth::id())->orderByDesc('created_at')->get();
        return view('front.transactions', compact('transactions'));

    }

    public function logout(Request $request) {
        Filament::auth()->logout();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.index');
    }
}

