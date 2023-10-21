<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use File;

class VideoController extends Controller
{
    public function index() {
        $videos = Video::orderBy('sort')->get();

        return view('admin.video.all', compact('videos'));
    }

    public function add() {
        $maxSort = Video::max('sort') + 1;
        return view('admin.video.add',compact('maxSort'));
    }

    public function addPost(Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'url_link' => 'nullable|string|max:255',
            'sort' => 'required|integer|min:1',
            'video' => 'required|mimes:mp4,jpg,png,jpeg',
            'status' => 'required'
        ]);

        // Upload Video
        $file = $request->file('video');
        $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
        $destinationPath = 'public/uploads/video';
        $file->move($destinationPath, $filename);

        $videoPath = 'uploads/video/'.$filename;

        $video = new Video();
        $video->title = $request->title;
        $video->sub_title = $request->sub_title;
        $video->url_link = $request->url_link;
        $video->sort = $request->sort;
        $video->video_url = $videoPath;
        $video->status = $request->status;
        $video->save();

        return redirect()->route('video')
            ->with('message', 'Video add successfully.');
    }

    public function edit(Video $video) {
        $ext     = explode('.', $video->video_url); // Explode the string
        $fileExtension  = end($ext);

        return view('admin.video.edit', compact('video','fileExtension'));
    }

    public function editPost(Video $video, Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'url_link' => 'nullable|string|max:255',
            'sort' => 'required|integer|min:1',
            'video' => 'nullable|mimes:mp4,jpg,png,jpeg',
            'status' => 'required'
        ]);

        $videoPath = $video->video_url;

        if ($request->file('video')) {
            // Previous Video
            if(File::exists(public_path($video->video_url))){
                File::delete(public_path($video->video_url));
            }

            // Upload Image
            $file = $request->file('video');
            $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
            $destinationPath = 'public/uploads/video';
            $file->move($destinationPath, $filename);

            $videoPath = 'uploads/video/'.$filename;
        }

        $video->title = $request->title;
        $video->sub_title = $request->sub_title;
        $video->url_link = $request->url_link;
        $video->sort = $request->sort;
        $video->video_url = $videoPath;
        $video->status = $request->status;
        $video->save();

        return redirect()->route('video')->with('message', 'Video edit successfully.');
    }

    public function delete(Request $request) {
        $video = Video::find($request->videoId);
        if(File::exists(public_path($video->video_url))){
            File::delete(public_path($video->video_url));
        }
        $video->delete();
        return response()->json(['success' => true, 'message' => 'Video deleted.']);

    }
}
