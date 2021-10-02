<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat() {
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(5);

        // $categories = DB::table('categories')->whereNull('deleted_at')->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);

        return view('admin.category.index', compact('categories'));
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

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => auth()->user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = auth()->user()->id;
        $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = auth()->user()->id;
        // DB::table('categories')->insert($data);

        // Category::create($validatedData);

        return redirect()->back()->with('success', 'Category Inserted Successfull');
    }

    public function Edit($id) {
        $categories = Category::find($id);

        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id) {
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('all.category')->with('success', 'Category Updated Successfull');
    }
}