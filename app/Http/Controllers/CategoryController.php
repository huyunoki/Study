<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();
        return redirect('/places/create');
    }
}
