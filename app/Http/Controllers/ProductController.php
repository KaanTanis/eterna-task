<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($username)
    {
        $user = User::where('user_name', $username)->firstOrFail();

        $categories = $user->categories;
        
        return view('cafe.index', compact('user', 'categories'));
    }

    public function category($username, $category)
    {
        $user = User::where('user_name', $username)->firstOrFail();

        $category = $user->categories()->where('slug', $category)->firstOrFail();

        $products = $category->products;

        return view('cafe.category', compact('user', 'category', 'products'));
    }

    public function show($username, $category, $product)
    {
        $user = User::where('user_name', $username)->firstOrFail();

        $category = $user->categories()->where('slug', $category)->firstOrFail();

        $product = $category->products()->where('slug', $product)->firstOrFail();

        return view('cafe.show', compact('user', 'category', 'product'));
    }
}
