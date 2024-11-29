<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jewelry;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('front.index', compact('categories'));
    }

    public function category(Category $categories) {
        $categories = Category::all();
        $jewelries = Jewelry::orderByDesc('id')->get();
        return view('front.jewelry', compact('categories', 'jewelries'));
    }

    public function cart() {
        $categories = Category::all();
        return view('front.cart', compact('categories'));
    }
}
