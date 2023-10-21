<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use File;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::orderBy('sort')->get();

        return view('admin.product_manage.category.all', compact('categories'));
    }

    public function add() {
        $maxSort = Category::max('sort') + 1;
        return view('admin.product_manage.category.add',compact('maxSort'));
    }

    public function addPost(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
            'sort' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $imageThumbs = null;
        $imageFullPath = null;

        if ($request->image) {
            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/category';
            $file->move($destinationPath, $filename);

            $imageFullPath = 'uploads/category/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(400, 572);
            $img->save(public_path('uploads/category/thumbs/'.$filename), 20);
            $imageThumbs = 'uploads/category/thumbs/'.$filename;
        }

        $category = new Category();
        $category->name = $request->name;
        $category->thumbs = $imageThumbs;
        $category->full_image = $imageFullPath;
        $category->slug = preg_replace('/\s+/u', '-', trim($request->name));
        $category->sort = $request->sort;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('category')->with('message', 'Category add successfully.');
    }

    public function edit(Category $category) {
        return view('admin.product_manage.category.edit', compact('category'));
    }

    public function editPost(Category $category, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'sort' => 'required|integer|min:1',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
            'status' => 'required'
        ]);

        if ($request->image) {

            if(File::exists(public_path($category->thumbs))){
                File::delete(public_path($category->thumbs));
            }
            if(File::exists(public_path($category->full_image))){
                File::delete(public_path($category->full_image));
            }

            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/category';
            $file->move($destinationPath, $filename);

            $category->full_image = 'uploads/category/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(400, 572);
            $img->save(public_path('uploads/category/thumbs/'.$filename), 20);
            $category->thumbs = 'uploads/category/thumbs/'.$filename;
        }

        $category->name = $request->name;
        $category->slug = preg_replace('/\s+/u', '-', trim($request->name));
        $category->sort = $request->sort;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('category')->with('message', 'Category edit successfully.');
    }
}
