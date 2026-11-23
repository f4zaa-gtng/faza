<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        if (! auth()->check()) {
            return view('home');
        }

        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $lowStockProducts = Product::where('stock', '<=', 5)->count();
        $recentProducts = Product::latest()->take(5)->get();

        return view('home', compact(
            'totalProducts',
            'totalStock',
            'lowStockProducts',
            'recentProducts'
        ));
    }
}
