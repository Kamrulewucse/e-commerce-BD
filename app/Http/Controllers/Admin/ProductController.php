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
use App\Models\ProductVideo;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;
use File;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category', 'subCategory', 'subSubCategory','unit')
                    ->where('type',1)
                    ->get();

//        foreach ($products as $product){
//
//            $selectProduct = Product::find($product->id);
//            $selectProduct->types()->attach(1);
//
//        }
//        dd('ok');

        return view('admin.product_manage.product.all', compact('products'));
    }
    public function add() {

        $categories = Category::where('status', 1)->orderBy('sort')->get();
        $brands = Brand::where('status', 1)->orderBy('sort')->get();
        $units = Unit::where('status', 1)->get();
        $colors = Color::orderBy('name')->get();
        $types = Type::orderBy('sort')->get();
        $collections = Collection::orderBy('sort')->get();

        return view('admin.product_manage.product.add',compact( 'categories','units',
        'brands','colors','collections','types'));
    }
    public function addPost(Request $request) {

        $rules = [
            'category' => 'required',
            'sub_category' => 'required',
            'sub_sub_category' => 'required',
            'short_description' => 'nullable',
            'features.*' => 'nullable',
            'unit' => 'required',
            'product_weight' => 'required',
            'color.*' => 'required',
            'type.*' => 'required',
            'images.*' => 'required',
            'video.*' => 'nullable',
            'name' => 'required|max:255',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        if ($request->color){
             $counter = 0;
                foreach ($request->color as $reqColor){
                $productSerialArray[] = (Color::find($reqColor)->name ?? '').'-'.(Type::find($request->type[$counter])->name ?? '');
                $counter++;
            }

            $duplicatesSerialArray = array_unique(array_diff_assoc($productSerialArray, array_unique($productSerialArray)));
            $duplicatesSerialString = implode (", ", $duplicatesSerialArray);
            if (count($duplicatesSerialArray) > 0){
                $message = $request->name.' Color & Type '.$duplicatesSerialString.' is duplicate, duplicate is not allowed';
                return response()->json(['success' => false, 'message' => $message]);
            }
        }


        $product = new Product();
        $product->type = 1;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->sub_sub_category_id = $request->sub_sub_category;
        $product->unit_id = $request->unit;
        $product->product_weight = $request->product_weight;
        $product->short_description = $request->short_description;
        $product->features = json_encode($request->features);
        $product->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.SubCategory::find($request->sub_category)->name.' '.SubSubCategory::find($request->sub_sub_category)->name.' '.$request->name)).'-'.Str::random(40);
        $product->status = $request->status;
        $product->save();

        $product->colors()->attach($request->color);
        $product->types()->attach($request->type);
        $product->collections()->attach($request->collection);

        $counter = 0;
        if ($request->color){
            foreach ($request->color as $reqColor){
                 $colorTypeIndex = $reqColor.'-'.$request->type[$counter];

                if ($request->video[$colorTypeIndex] ?? false){
                        // Upload video
                        $fileVideo = $request->file('video')[$colorTypeIndex];
                        $filenameVideo = Uuid::uuid1()->toString().'.'.$fileVideo->getClientOriginalExtension();
                        $destinationPathVideo = 'public/uploads/product/video';
                        $fileVideo->move($destinationPathVideo, $filenameVideo);
                        $videoFullPath = 'uploads/product/video/'.$filenameVideo;


                        $video = new ProductVideo();
                        $video->product_id = $product->id;
                        $video->color_id = $reqColor;
                        $video->type_id = $request->type[$counter];
                        $video->video_path = $videoFullPath;
                        $video->save();

                }

                $subCounter = 0;
                if ($request->images[$colorTypeIndex] ?? false){
                    foreach ($request->images[$colorTypeIndex] as $reqImage){
                        $imageThumbs = null;
                        $imageFullPath = null;
                        if ($reqImage) {
                            // Upload Image
                            $file = $request->file('images')[$colorTypeIndex][$subCounter];
                            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
                            $destinationPath = 'public/uploads/product';
                            $file->move($destinationPath, $filename);
                            $imageFullPath = 'uploads/product/'.$filename;
                            // Thumbs
                            $img = Image::make($destinationPath.'/'.$filename);
                            $img->save(public_path('uploads/product/thumbs/'.$filename), 20);
                            $imageThumbs = 'uploads/product/thumbs/'.$filename;
                        }

                        $image = new ProductImage();
                        $image->product_id = $product->id;
                        $image->color_id = $reqColor;
                        $image->type_id = $request->type[$counter];
                        $image->thumbs = $imageThumbs;
                        $image->image_full = $imageFullPath;
                        $image->save();

                        $subCounter++;
                    }
                }


                $counter++;
            }
        }
        return response()->json(['success' => true, 'message' => 'Product add successfully.']);
    }

    public function edit(Product $product) {
        $categories = Category::where('status', 1)->orderBy('sort')->get();
        $brands = Brand::where('status', 1)->orderBy('sort')->get();
        $units = Unit::where('status', 1)->get();
        $colors = Color::orderBy('name')->get();
        $types = Type::orderBy('sort')->get();
        $collections = Collection::orderBy('sort')->get();

        return view('admin.product_manage.product.edit',compact('product',
            'categories','brands','units','colors','collections','types'));
    }

    public function editPost(Request $request) {

        $product = Product::find($request->product_id);

        $rules = [
            'category' => 'required',
            'sub_category' => 'required',
            'sub_sub_category' => 'required',
            'short_description' => 'nullable',
            'unit' => 'required',
            'product_weight' => 'required',
            'features.*' => 'nullable',
            'color.*' => 'required',
            'type.*' => 'required',
            'images.*' => 'required',
            'name' => 'required|max:255',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }


        if ($request->color){
            $counter = 0;
            $productSerialArray = [];
            foreach ($request->color as $reqColor){
                $productSerialArray[] = (Color::find($reqColor)->name ?? '').'-'.(Type::find($request->type[$counter])->name ?? '');
                $counter++;
            }

            $duplicatesSerialArray = array_unique(array_diff_assoc($productSerialArray, array_unique($productSerialArray)));
            $duplicatesSerialString = implode (", ", $duplicatesSerialArray);

            if (count($duplicatesSerialArray) > 0){
                $message = $request->name.' Color & Type '.$duplicatesSerialString.' is duplicate, duplicate is not allowed';
                return response()->json(['success' => false, 'message' => $message]);
            }
        }



        $previousColorTypeId =[];
        $previousImageId =[];
        $previousVideoId =[];

        if ($product->colors){
            foreach ($product->colors as $key => $oldColor) {
                $previousColorTypeId[] = $oldColor->id.'-'.$product->types[$key]->id;
            }
            if (count($product->colorImages) > 0){
                foreach ($product->colorImages as $oldImageId) {
                    $previousImageId[] = $oldImageId->id;
                }
            }
            if (count($product->colorVideos) > 0){
                foreach ($product->colorVideos as $oldVideoId) {
                    $previousVideoId[] = $oldVideoId->id;
                }
            }

        }
        if ($request->color){
            $counter = 0;
            foreach ($request->color as $reqColor) {
                if ($request->old_image_id[$reqColor.'-'.$request->type[$counter]] ?? false){
                    foreach ($request->old_image_id[$reqColor.'-'.$request->type[$counter]] as $reqImgId){
                        if (in_array($reqImgId,$previousImageId)){
                            if (($key = array_search($reqImgId, $previousImageId)) !== false) {
                                unset($previousImageId[$key]);
                            }
                        }
                    }
                }

                if ($request->old_video_id[$reqColor.'-'.$request->type[$counter]] ?? false){
                        if (in_array($request->old_video_id[$reqColor.'-'.$request->type[$counter]],$previousVideoId)){
                            if (($key = array_search($request->old_video_id[$reqColor.'-'.$request->type[$counter]], $previousVideoId)) !== false) {
                                unset($previousVideoId[$key]);
                            }

                    }
                }

                $counter++;
            }
        }


        if (count($previousImageId) > 0){
            foreach ($previousImageId as $unsetOldImgId){
                $deleteImage = ProductImage::where('id',$unsetOldImgId)
                         ->first();
                if(File::exists(public_path($deleteImage->thumbs))){
                    File::delete(public_path($deleteImage->thumbs));
                }
                if(File::exists(public_path($deleteImage->image_full))){
                    File::delete(public_path($deleteImage->image_full));
                }
                $deleteImage->delete();
            }
        }
        if (count($previousVideoId) > 0){
            foreach ($previousVideoId as $unsetOldVideoId){
                $deleteVideo = ProductVideo::where('id',$unsetOldVideoId)
                    ->first();
                if(File::exists(public_path($deleteVideo->video_path))){
                    File::delete(public_path($deleteVideo->video_path));
                }

                $deleteVideo->delete();
            }
        }

        $counter = 0;
        if ($request->color){
                foreach ($request->color as $reqColor) {

                    if (in_array($reqColor.'-'.$request->type[$counter], $previousColorTypeId)) {
                        if ($request->file('images')[$reqColor.'-'.$request->type[$counter]] ?? false){
                            foreach ($request->file('images')[$reqColor.'-'.$request->type[$counter]] as $key=> $reqImageFile){
                                // Upload Image
                                $filename = Uuid::uuid1()->toString().'.'.$reqImageFile->getClientOriginalExtension();
                                $destinationPath = 'public/uploads/product';
                                $reqImageFile->move($destinationPath, $filename);

                                $imageFullPath = 'uploads/product/'.$filename;
                                // Thumbs
                                $img = Image::make($destinationPath.'/'.$filename);
                               // $img->resize(656, 656);
                                $img->save(public_path('uploads/product/thumbs/'.$filename), 20);
                                $imageThumbs = 'uploads/product/thumbs/'.$filename;

                                if ($request->old_image_id[$reqColor.'-'.$request->type[$counter]][$key] ?? false){
                                    $checkOldImageId = $request->old_image_id[$reqColor.'-'.$request->type[$counter]][$key] ?? false;
                                    $image = ProductImage::where('id',$checkOldImageId)->first();

                                    if ($image){
                                        if(File::exists(public_path($image->thumbs))){
                                            File::delete(public_path($image->thumbs));
                                        }
                                        if(File::exists(public_path($image->image_full))){
                                            File::delete(public_path($image->image_full));
                                        }
                                    }
                                }else{
                                    $image = new ProductImage();
                                }

                                $image->product_id = $product->id;
                                $image->color_id = $reqColor;
                                $image->type_id = $request->type[$counter];
                                $image->thumbs = $imageThumbs;
                                $image->image_full = $imageFullPath;
                                $image->save();
                            }
                        }

                        //video

                        if ($request->file('video')[$reqColor.'-'.$request->type[$counter]] ?? false){
                                // Upload Video
                                $reqVideoFile = $request->file('video')[$reqColor.'-'.$request->type[$counter]];
                                $filenameVideo = Uuid::uuid1()->toString().'.'.$reqVideoFile->getClientOriginalExtension();
                                $destinationPathVideo = 'public/uploads/product/video';
                                $reqVideoFile->move($destinationPathVideo, $filenameVideo);
                                $videoFullPath = 'uploads/product/video/'.$filenameVideo;

                                if ($request->old_video_id[$reqColor.'-'.$request->type[$counter]] ?? false){
                                    $checkOldVideoId = $request->old_video_id[$reqColor.'-'.$request->type[$counter]] ?? false;
                                    $video = ProductVideo::where('id',$checkOldVideoId)->first();

                                    if ($video){
                                        if(File::exists(public_path($video->video_path))){
                                            File::delete(public_path($video->video_path));
                                        }
                                    }
                                }else{
                                    $video = new ProductVideo();
                                }

                                $video->product_id = $product->id;
                                $video->color_id = $reqColor;
                                $video->type_id = $request->type[$counter];
                                $video->video_path = $videoFullPath;
                                $video->save();

                        }


                        if (($key = array_search($reqColor.'-'.$request->type[$counter], $previousColorTypeId)) !== false) {
                            unset($previousColorTypeId[$key]);
                        }

                    }else{

                       $oldImagesId = $request->old_image_id[$reqColor.'-'.$request->type[$counter]] ?? false;
                      if ($oldImagesId){
                          ProductImage::whereIn('id',$oldImagesId)
                              ->update([
                                  'color_id'=>$reqColor,
                                  'type_id'=>$request->type[$counter],
                              ]);
                      }
                        $oldVideosId = $request->old_video_id[$reqColor.'-'.$request->type[$counter]] ?? false;
                        if ($oldVideosId){
                            ProductVideo::whereIn('id',$oldVideosId)
                                ->update([
                                    'color_id'=>$reqColor,
                                    'type_id'=>$request->type[$counter],
                                ]);
                        }


                        if ($request->file('images')[$reqColor.'-'.$request->type[$counter]] ?? false){
                            foreach ($request->file('images')[$reqColor.'-'.$request->type[$counter]] as $key=> $reqImageFile){
                                // Upload Image
                                $filename = Uuid::uuid1()->toString().'.'.$reqImageFile->getClientOriginalExtension();
                                $destinationPath = 'public/uploads/product';
                                $reqImageFile->move($destinationPath, $filename);
                                $imageFullPath = 'uploads/product/'.$filename;
                                // Thumbs
                                $img = Image::make($destinationPath.'/'.$filename);
                               // $img->resize(656, 656);
                                $img->save(public_path('uploads/product/thumbs/'.$filename), 20);
                                $imageThumbs = 'uploads/product/thumbs/'.$filename;

                                $image = new ProductImage();
                                $image->product_id = $product->id;
                                $image->color_id = $reqColor;
                                $image->type_id = $request->type[$counter];
                                $image->thumbs = $imageThumbs;
                                $image->image_full = $imageFullPath;
                                $image->save();
                            }
                        }
                        //video

                        if ($request->file('video')[$reqColor.'-'.$request->type[$counter]] ?? false){

                                // Upload video
                                $reqVideoFile = $request->file('video')[$reqColor.'-'.$request->type[$counter]];
                                $filenameVideo = Uuid::uuid1()->toString().'.'.$reqVideoFile->getClientOriginalExtension();
                                $destinationPathVideo = 'public/uploads/product/video';
                                $reqVideoFile->move($destinationPathVideo, $filenameVideo);
                                $videoFullPath = 'uploads/product/video/'.$filenameVideo;

                                $video = new ProductVideo();
                                $video->product_id = $product->id;
                                $video->color_id = $reqColor;
                                $video->type_id = $request->type[$counter];
                                $video->video_path = $videoFullPath;
                                $video->save();
                        }
                    }
                    $counter++;
                }

        }

        // Delete items
        if (count($previousColorTypeId) > 0){

            foreach ($previousColorTypeId as $colorId) {
                $strExplode = $colorId;
                $colorTypeId = explode("-",$strExplode);

                $checkInventory = Inventory::where('product_id',$product->id)
                        ->where('color_id',$colorTypeId[0])
                        ->where('type_id',$colorTypeId[1])
                        ->first();
                $color = Color::find($colorTypeId[0]);
                $type = Type::find($colorTypeId[1]);

                if ($checkInventory){
                    //return response()->json(['success' => false, 'message' => 'Opps, This ' .$color->name. 'product have inventory record, could not delete']);
                }

                $images = ProductImage::where('product_id', $product->id)
                    ->where('color_id', $color->id)
                    ->where('type_id', $type->id)
                    ->get();

                $videos = ProductVideo::where('product_id', $product->id)
                    ->where('color_id', $color->id)
                    ->where('type_id', $type->id)
                    ->get();

                if (count($images) > 0){
                    foreach ($images as $image){
                        $productImage = ProductImage::where('id',$image->id)->first();

                        if(File::exists(public_path($productImage->thumbs))){
                            File::delete(public_path($productImage->thumbs));
                        }
                        if(File::exists(public_path($productImage->image_full))){
                            File::delete(public_path($productImage->image_full));
                        }
                    }
                }
                if (count($videos) > 0){
                    foreach ($videos as $video){
                        $productVideo = ProductVideo::where('id',$video->id)->first();

                        if(File::exists(public_path($productVideo->video_path))){
                            File::delete(public_path($productVideo->video_path));
                        }

                    }
                }
            }
        }
        if ($request->name != $product->name)
            $product->slug = preg_replace('/\s+/u', '-', trim(Category::find($request->category)->name.' '.SubCategory::find($request->sub_category)->name.' '.SubSubCategory::find($request->sub_sub_category)->name.' '.$request->name)).Str::random(40);

        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->sub_sub_category_id = $request->sub_sub_category;
        $product->unit_id = $request->unit;
        $product->product_weight = $request->product_weight;
        $product->short_description = $request->short_description;
        $product->features = json_encode($request->features);
        $product->brand_id = $request->brand;
        $product->status = $request->status;
        $product->save();

        $product->colors()->detach();
        $product->types()->detach();
        $product->collections()->detach();

        $product->colors()->attach($request->color);
        $product->types()->attach($request->type);
        $product->collections()->attach($request->collection);

        return response()->json(['success' => true, 'message' => 'Product updated successfully.']);
    }

    public function productDatatable()
    {
        $query = Product::where('type',1)
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
