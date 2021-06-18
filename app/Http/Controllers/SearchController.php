<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request) {
        $products = Product::where('name', 'LIKE', "%$request->search%")
            ->where('status', 2)
            ->paginate(10);
        return view('search.index', compact('products'));
    }
}
