<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;

class MenuController extends Controller
{
    // Shows the full menu grouped by category
    public function index()
    {
        $categories = Category::orderBy('order')
                               ->with('menuItems')
                               ->get();

        return view('menu.index', compact('categories'));
    }

    // Shows a single category and its items
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
                             ->with('menuItems')
                             ->firstOrFail();

        return view('menu.category', compact('category'));
    }
}