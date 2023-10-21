<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;
use File;

class ViewByLookProductController extends Controller
{
    public function index() {
        $products = Product::with('category', 'subCategory', 'subSubCategory','unit')
                            ->where('type',2)
                            ->get();
        return view('admin.product_manage.view_by_look_product.all', compact('products'));
    }
    public function add() {
        $categories = Category::where('status', 1)->orderBy('sort')->get();
        $products = Inventory::with('product')
            ->select('product_id','color_id','type_id')
            ->groupBy('product_id','color_id','type_id')
            ->get();
        $collections = Collection::orderBy('sort')->get();
        return view('admin.product_manage.view_by_look_product.add',compact( 'products',
            'categories','collections'));
    }
    public function addPost(Request $request) {

        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
            'sub_sub_category' => 'required',
            'features' => 'required',
            'include_products' => 'nullable',
            'name' => 'required|max:255',
            'image' => 'required|mimes:jpg,jpeg,png,webp',
            'status' => 'required',
        ]);
        // Upload Image
        $file = $request->file('image');
        $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
        $destinationPath = 'public/uploads/product';
        $file->move($destinationPath, $filename);
        $imageFullPath = 'uploads/product/'.$filename;

        // Thumbs
        $img = Image::make($destinationPath.'/'.$filename);
        $img->resize(1240, 1860);
        $img->save(public_path('uploads/product/thumbs/'.$filename), 50);
        $imageThumbs = 'uploads/product/thumbs/'.$filename;


        $videoPath = null;
       if ($request->file('video')) {

        // Upload Video
        $file = $request->file('video');
        $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
        $destinationPath = 'uploads/view_by_look_vedio';
        $file->move($destinationPath, $filename);
        $videoPath = 'uploads/view_by_look_vedio/'.$filename;

           $videoPath = 'uploads/view_by_look_vedio/' . $filename;
        }


        $product = new Product();
        $product->type = 2;
        $product->view_image = $imageFullPath;
        $product->view_thumb = $imageThumbs;
        $product->include_products = json_encode($request->include_products);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->sub_sub_category_id = $request->sub_sub_category;
        $product->features = $request->features;
        $product->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.SubCategory::find($request->sub_category)->name.' '.SubSubCategory::find($request->sub_sub_category)->name.' '.$request->name)).Str::random(40);
        $product->video_url = $videoPath;
        $product->status = $request->status;
        $product->save();
        $product->collections()->attach($request->collection);
        return redirect()->route('view_by_look_product')->with('message', 'View By Look Product add successfully.');
    }

    public function edit(Product $product) {
        $categories = Category::where('status', 1)->orderBy('sort')->get();
        $products = Inventory::with('product')->select('product_id','color_id','type_id')
                    ->groupBy('product_id','color_id','type_id')
                    ->get();
        $collections = Collection::orderBy('sort')->get();

        $ext     = explode('.', $product->video_url); // Explode the string
        $fileExtension  = end($ext);

        return view('admin.product_manage.view_by_look_product.edit',compact('product',
            'categories','products','collections','fileExtension'));
    }

    public function editPost(Product $product, Request $request) {
        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
            'sub_sub_category' => 'required',
            'features' => 'nullable',
            'include_products' => 'nullable',
            'name' => 'required|max:255',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp',
            'status' => 'required',
        ]);


        if ($request->file('image')){

            if(File::exists(public_path($product->view_image))){
                File::delete(public_path($product->view_image));
            }
            if(File::exists(public_path($product->view_thumb))){
                File::delete(public_path($product->view_thumb));
            }

            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/product';
            $file->move($destinationPath, $filename);
            $imageFullPath = 'uploads/product/'.$filename;
            // Thumbs
            $img = Image::make($destinationPath.'/'.$filename);
            $img->resize(1240, 1860);
            $img->save(public_path('uploads/product/thumbs/'.$filename), 50);
            $imageThumbs = 'uploads/product/thumbs/'.$filename;

            $product->view_image = $imageFullPath;
            $product->view_thumb = $imageThumbs;
        }

        if ($request->file('video')) {
            // Previous Video
            if (File::exists(public_path($product->video_url))) {
                File::delete(public_path($product->video_url));
            }

            // Upload Image
            $file = $request->file('video');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'uploads/view_by_look_vedio';
            $file->move($destinationPath, $filename);

            $product->video_url = 'uploads/view_by_look_vedio/' . $filename;
        }

        if ($request->name != $product->name)
            $product->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.SubCategory::find($request->sub_category)->name.' '.SubSubCategory::find($request->sub_sub_category)->name.' '.$request->name)).Str::random(40);


        $product->include_products = json_encode($request->include_products);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->sub_sub_category_id = $request->sub_sub_category;
        $product->features = $request->features;

        $product->status = $request->status;
        $product->save();
        $product->collections()->sync($request->collection);

        return redirect()->route('view_by_look_product')->with('message', 'View By Look Product edit successfully.');
    }

    public function productDatatable()
    {
        $query = Product::where('type',2)
                ->with('category','subCategory','subSubCategory');
        return DataTables::eloquent($query)

            ->editColumn('category', function (Product $product) {
                return $product->category->name;
            })
            ->editColumn('sub_category', function (Product $product) {
                return $product->subCategory->name;
            })
            ->editColumn('sub_sub_category', function (Product $product) {
                return $product->subSubCategory->name;
            })

            ->addColumn('action', function (Product $product) {
                return '<a class="btn btn-info btn-sm" href="'.route('admin.product.edit', ['product' => $product->id]).'">Edit</a>';
            })
            ->editColumn('image', function (Product $product) {
                return '<img src="' . asset($product->image) . '" height="50px">';
            })
            ->editColumn('status', function (Product $product) {
                if ($product->status == 1)
                    return '<span class="label label-success"> Active</span>';
                else
                    return '<span class="label label-warning"> Inactive </span>';

            })
            ->rawColumns(['action', 'image','status'])
            ->toJson();
    }
    public function getSubCategory(Request $request) {
        $subCategories = SubCategory::where('category_id', $request->categoryId)
            ->where('status', 1)
            ->orderBy('sort')
            ->get()->toArray();
        return response()->json($subCategories);
    }

    public function getSubSubCategory(Request $request) {
        $subSubCategories = SubSubCategory::where('sub_category_id', $request->subCategoryId)
           ->where('by_style',1)
            ->where('status', 1)
            ->orderBy('sort')
            ->get()->toArray();

        return response()->json($subSubCategories);
    }
    public function getViewByLookSubSubCategory(Request $request) {
        $subSubCategories = SubSubCategory::where('sub_category_id', $request->subCategoryId)
            ->where('by_style',0)
            ->where('status', 1)
            ->orderBy('sort')
            ->get()->toArray();

        return response()->json($subSubCategories);
    }

}
