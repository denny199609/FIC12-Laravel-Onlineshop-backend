<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //index
    public function index(Request $request) {
        $categories = DB::table('categories')
            ->where('name', 'like', '%'.$request->search.'%')
            ->paginate(5);
        return view('pages.category.index', compact('categories'));
    }
}
