<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\MagazineCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use File;

class MagazineController extends Controller
{
    public function index() {

        $magazines = Magazine::latest()->get();
        return view('admin.magazine.all', compact('magazines'));
    }

    public function add() {
        $categories = MagazineCategory::orderBy('sort')->get();
        return view('admin.magazine.add',compact('categories'));
    }

    public function addPost(Request $request) {

        $request->validate([
            'title' => 'required|string|max:255|unique:magazines',
            'category' => 'required',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,webp',
            'status' => 'required',
        ]);
        // Upload Video
        $file = $request->file('image');
        $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
        $destinationPath = 'public/uploads/magazine';
        $file->move($destinationPath, $filename);
        // Thumbs
        $img = Image::make($destinationPath.'/'.$filename);
        $img->resize(1080, 1080);
        $img->save(public_path('uploads/magazine/'.$filename), 20);
        $thumbsPath = 'uploads/magazine/'.$filename;



        //text Editor to save image
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($request->description);
        libxml_clear_errors();

        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image){

            $data = $image->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name= "/uploads/magazine/" . time().$item.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', asset($image_name));
        }

        $content = $dom->saveHTML();

        $magazine = new Magazine();
        $magazine->slug = preg_replace('/\s+/u', '-', trim(strtolower($request->title)));
        $magazine->image = $thumbsPath;
        $magazine->magazine_category_id = $request->category;
        $magazine->sub_title = $request->sub_title;
        $magazine->title = $request->title;
        $magazine->description = $content;
        $magazine->home_featured = $request->home_featured ? 1 : 0;
        $magazine->category_featured = $request->category_featured ? 1 : 0;
        $magazine->status = $request->status;
        $magazine->save();

        return redirect()->route('magazine')->with('message', 'Magazine add successfully.');
    }

    public function edit(Magazine $magazine) {
        $categories = MagazineCategory::orderBy('sort')->get();
        return view('admin.magazine.edit', compact('magazine','categories'));
    }

    public function editPost(Magazine $magazine, Request $request)
    {

        $request->validate([
            'title' => [
                'required', 'max:255',
                Rule::unique('magazines')
                    ->where('title', $request->title)
                    ->ignore($magazine)
            ],
            'category' => 'required',
            'sub_title' => 'nullable|max:255',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
            'status' => 'required',
        ]);
        if ($request->hasFile('image')) {
            // Previous Image
            if (File::exists(public_path($magazine->image))) {
                File::delete(public_path($magazine->image));
            }

            // Upload Image
            $file = $request->file('image');
            $filename = Uuid::uuid1()->toString() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/magazine';
            $file->move($destinationPath, $filename);
            // Thumbs
            $img = Image::make($destinationPath . '/' . $filename);
            $img->resize(1080, 1080);
            $img->save(public_path('uploads/magazine/' . $filename), 20);
            $thumbsPath = 'uploads/magazine/' . $filename;
            $magazine->image = $thumbsPath;
        }

        if ($request->description != $magazine->description){
            //text Editor to save image
            $dom = new \DomDocument();
            @$dom->loadHtml($request->description,true);
            $imageFile = $dom->getElementsByTagName('img');

            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $imgeData = base64_decode($data);
                    $image_name= "/uploads/magazine/" . time().$item.'.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $imgeData);

                    $image->removeAttribute('src');
                    $image->setAttribute('src', asset($image_name));


            }

            $magazine->description = $dom->saveHTML();
        }


        $magazine->slug = preg_replace('/\s+/u', '-', trim(strtolower($request->title)));
        $magazine->magazine_category_id = $request->category;
        $magazine->sub_title = $request->sub_title;
        $magazine->title = $request->title;
        $magazine->status = $request->status;
        $magazine->home_featured = $request->home_featured ? 1 : 0;
        $magazine->category_featured = $request->category_featured ? 1 : 0;
        $magazine->save();

        return redirect()->route('magazine')->with('message', 'Magazine edit successfully.');
    }
}
