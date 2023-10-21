<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use File;

class SubCategoryController extends Controller
{
    public function index() {
        $subCategories = SubCategory::orderBy('sort')->get();
        return view('admin.product_manage.sub_category.all', compact('subCategories'));
    }

    public function add() {
        $categories = Category::orderBy('sort')->get();
        $maxSort = SubCategory::max('sort') + 1;
        return view('admin.product_manage.sub_category.add', compact('categories','maxSort'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'category' => 'required',
            'name' => [
                'required','max:255',
                Rule::unique('sub_categories')
                    ->where('name', $request->name)
                    ->where('category_id', $request->category)
            ],
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
            $destinationPath = 'public/uploads/sub_category';
            $file->move($destinationPath, $filename);

            $imageFullPath = 'uploads/sub_category/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(400, 572);
            $img->save(public_path('uploads/sub_category/thumbs/'.$filename), 20);
            $imageThumbs = 'uploads/sub_category/thumbs/'.$filename;
        }

        $subCategory = new SubCategory();
        $subCategory->thumbs = $imageThumbs;
        $subCategory->full_image = $imageFullPath;
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.$request->name));
        $subCategory->sort = $request->sort;
        $subCategory->status = $request->status;
        $subCategory->save();

        return redirect()->route('sub_category')->with('message', 'Sub Category add successfully.');
    }

    public function edit(SubCategory $subCategory) {
        $categories = Category::orderBy('sort')->get();

        return view('admin.product_manage.sub_category.edit', compact('subCategory', 'categories'));
    }

    public function editPost(SubCategory $subCategory, Request $request) {
        $request->validate([
            'category' => 'required',
            'name' => [
                'required','max:255',
                Rule::unique('sub_categories')
                    ->ignore($subCategory)
                    ->where('name', $request->name)
                    ->where('category_id', $request->category)
            ],
            'sort' => 'required|integer|min:1',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
            'status' => 'required'
        ]);
        if ($request->image) {

            if(File::exists(public_path($subCategory->thumbs))){
                File::delete(public_path($subCategory->thumbs));
            }
            if(File::exists(public_path($subCategory->full_image))){
                File::delete(public_path($subCategory->full_image));
            }

            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/sub_category';
            $file->move($destinationPath, $filename);

            $subCategory->full_image = 'uploads/sub_category/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(400, 572);
            $img->save(public_path('uploads/sub_category/thumbs/'.$filename), 20);
            $subCategory->thumbs = 'uploads/sub_category/thumbs/'.$filename;
        }
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.$request->name));
        $subCategory->sort = $request->sort;
        $subCategory->status = $request->status;
        $subCategory->save();

        return redirect()->route('sub_category')->with('message', 'Sub Category edit successfully.');
    }
}
