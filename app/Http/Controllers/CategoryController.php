<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function AllCat() {
        return view('admin.category.index');
    }

    public function AddCat(Request $request) {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:25'
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.unique' => 'This name already exists',
            'category_name.max' => 'Category Less Then 25 characters',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }
}
