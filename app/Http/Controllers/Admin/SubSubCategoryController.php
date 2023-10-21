<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use File;

class SubSubCategoryController extends Controller
{
    public function index() {
        $subSubCategories = SubSubCategory::orderBY('sort')->get();
        return view('admin.product_manage.sub_sub_category.all', compact('subSubCategories'));
    }

    public function add() {
        $categories = Category::orderBy('sort')->get();
        $maxSort = SubSubCategory::max('sort') + 1;
        return view('admin.product_manage.sub_sub_category.add', compact('categories','maxSort'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
            'description' => 'nullable|max:5000',
            'by_style' => 'nullable',
            'name' => [
                'required','max:255',
                Rule::unique('sub_sub_categories')
                    ->where('name', $request->name)
                    ->where('category_id', $request->category)
                    ->where('sub_category_id', $request->sub_category)
            ],
            'sort' => 'required|integer|min:1',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
            'status' => 'required'
        ]);
        $imageThumbs = null;
        $imageFullPath = null;

        if ($request->image) {
            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/sub_sub_category';
            $file->move($destinationPath, $filename);

            $imageFullPath = 'uploads/sub_sub_category/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            //$img->resize(2000, 2000);
            $img->save(public_path('uploads/sub_sub_category/thumbs/'.$filename), 40);
            $imageThumbs = 'uploads/sub_sub_category/thumbs/'.$filename;
        }

        $subSubCategory = new SubSubCategory();
        $subSubCategory->thumbs = $imageThumbs;
        $subSubCategory->full_image = $imageFullPath;
        $subSubCategory->by_style = $request->by_style ? 1 : 0;
        $subSubCategory->description = $request->description;
        $subSubCategory->category_id = $request->category;
        $subSubCategory->sub_category_id = $request->sub_category;
        $subSubCategory->name = $request->name;
        $subSubCategory->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.SubCategory::find($request->sub_category)->name.' '.$request->name));
        $subSubCategory->sort = $request->sort;
        $subSubCategory->status = $request->status;
        $subSubCategory->save();

        return redirect()->route('sub_sub_category')->with('message', 'Sub Sub Category add successfully.');
    }

    public function edit(SubSubCategory $subSubCategory) {
        $categories = Category::orderBy('sort')->get();
        return view('admin.product_manage.sub_sub_category.edit', compact('subSubCategory', 'categories'));
    }

    public function editPost(SubSubCategory $subSubCategory, Request $request) {
        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
            'description' => 'nullable|max:5000',
            'by_style' => 'nullable',
            'name' => [
                'required','max:255',
                Rule::unique('sub_sub_categories')
                    ->ignore($subSubCategory)
                    ->where('name', $request->name)
                    ->where('category_id', $request->category)
                    ->where('sub_category_id', $request->sub_category)
            ],
            'sort' => 'required|integer|min:1',
            'status' => 'required'
        ]);
        if ($request->image) {

            if(File::exists(public_path($subSubCategory->thumbs))){
                File::delete(public_path($subSubCategory->thumbs));
            }
            if(File::exists(public_path($subSubCategory->full_image))){
                File::delete(public_path($subSubCategory->full_image));
            }

            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/sub_sub_category';
            $file->move($destinationPath, $filename);

            $subSubCategory->full_image = 'uploads/sub_sub_category/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            //$img->resize(2000, 2000);
            //$img->fit(2000, 2000);
            $img->save(public_path('uploads/sub_sub_category/thumbs/'.$filename), 40);
            $subSubCategory->thumbs = 'uploads/sub_sub_category/thumbs/'.$filename;
        }
        $subSubCategory->by_style = $request->by_style ? 1 : 0;
        $subSubCategory->description = $request->description;
        $subSubCategory->category_id = $request->category;
        $subSubCategory->sub_category_id = $request->sub_category;
        $subSubCategory->name = $request->name;
        $subSubCategory->sort = $request->sort;
        $subSubCategory->status = $request->status;
        $subSubCategory->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.SubCategory::find($request->sub_category)->name.' '.$request->name));
        $subSubCategory->save();

        return redirect()->route('sub_sub_category')->with('message', 'Sub Sub Category edit successfully.');
    }

    public function getSubCategory(Request $request) {
        $subCategories = SubCategory::where('category_id', $request->categoryId)
            ->orderBy('sort')
            ->get()->toArray();
        return response()->json($subCategories);
    }
}
