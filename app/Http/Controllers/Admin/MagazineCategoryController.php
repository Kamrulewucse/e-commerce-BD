<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MagazineCategory;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class MagazineCategoryController extends Controller
{
    public function index() {

        $categories = MagazineCategory::orderBy('sort')->get();
        return view('admin.magazine.category.all', compact('categories'));
    }

    public function add() {
        $maxSort = MagazineCategory::max('sort') + 1;
        return view('admin.magazine.category.add',compact('maxSort'));
    }

    public function addPost(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255|unique:magazine_categories',
            'description' => 'nullable|max:500',
            'sort' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $category = new MagazineCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = preg_replace('/\s+/u', '-', trim(strtolower($request->name)));
        $category->sort = $request->sort;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('magazine_category')->with('message', 'Category add successfully.');
    }

    public function edit(MagazineCategory $category) {
        return view('admin.magazine.category.edit', compact('category'));
    }

    public function editPost(MagazineCategory $category, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:magazine_categories,name,'.$category->id,
            'description' => 'nullable|max:500',
            'sort' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = preg_replace('/\s+/u', '-', trim(strtolower($request->name)));
        $category->sort = $request->sort;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('magazine_category')->with('message', 'Category edit successfully.');
    }
}
