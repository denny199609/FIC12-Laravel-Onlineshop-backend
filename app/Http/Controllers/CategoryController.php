<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function create() {
        return view('pages.category.create');

    }

    public function store(Request $request) {
        //validate the request name required
        $validate = $request->validate([
            'name' => 'required'
        ]);
        // $data = $request->all();
        Category::create($validate
    );
        return redirect()->route('category.index')->with('success', 'Category Created Successfully');
    }

    //edit category
    public function edit(Category $category) {
        return view('pages.category.edit', compact('category'));
    }

    public function update(Category $category, Request $request) {
        $validate = $request->validate([
            'name' => 'required'
        ]);
        $category->update($validate);
        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category Deleted Successfully');
    }
}
