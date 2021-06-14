<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {
        $categories = Category::has('products')->get();
        return view('welcome', compact('categories'));
    }
}
