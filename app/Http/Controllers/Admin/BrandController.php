<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use File;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::orderBy('name')->get();
        return view('admin.product_manage.brand.all', compact('brands'));
    }

    public function add() {
        $maxSort = Brand::max('sort') + 1;
        return view('admin.product_manage.brand.add',compact('maxSort'));
    }

    public function addPost(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255|unique:brands',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
            'sort' => 'required|integer|min:1',
            'status' => 'required',
        ]);
        $imageThumbs = null;
        $imageFullPath = null;

        if ($request->image) {
            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/brand';
            $file->move($destinationPath, $filename);

            $imageFullPath = 'uploads/brand/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(400, 572);
            $img->save(public_path('uploads/brand/thumbs/'.$filename), 20);
            $imageThumbs = 'uploads/brand/thumbs/'.$filename;
        }

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->thumbs = $imageThumbs;
        $brand->full_image = $imageFullPath;
        $brand->slug = preg_replace('/\s+/u', '-', trim($request->name));
        $brand->sort = $request->sort;
        $brand->status = $request->status;
        $brand->save();

        return redirect()->route('brand')->with('message', 'Brand add successfully.');
    }

    public function edit(Brand $brand) {
        return view('admin.product_manage.brand.edit', compact('brand'));
    }

    public function editPost(Brand $brand, Request $request) {
        $request->validate([
            'name' =>  [
                'required','string','max:255',
                Rule::unique('brands')
                    ->ignore($brand)
                    ->where('name', $request->name)
            ],
            'sort' => 'required|integer|min:1',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
            'status' => 'required'
        ]);
        if ($request->image) {

            if(File::exists(public_path($brand->thumbs))){
                File::delete(public_path($brand->thumbs));
            }
            if(File::exists(public_path($brand->full_image))){
                File::delete(public_path($brand->full_image));
            }

            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/brand';
            $file->move($destinationPath, $filename);

            $brand->full_image = 'uploads/brand/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(400, 572);
            $img->save(public_path('uploads/brand/thumbs/'.$filename), 20);
            $brand->thumbs = 'uploads/brand/thumbs/'.$filename;
        }

        $brand->name = $request->name;
        $brand->slug = preg_replace('/\s+/u', '-', trim($request->name));
        $brand->sort = $request->sort;
        $brand->status = $request->status;
        $brand->save();

        return redirect()->route('brand')->with('message', 'Brand edit successfully.');
    }
}
