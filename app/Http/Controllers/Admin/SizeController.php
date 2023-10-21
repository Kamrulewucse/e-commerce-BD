<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{
    public function index() {
        $sizes = Size::orderBy('sort')->get();

        return view('admin.product_manage.size.all', compact('sizes'));
    }

    public function add() {
        $maxSort = Size::max('sort') + 1;
        return view('admin.product_manage.size.add',compact('maxSort'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required',
        ]);

        $size = new Size();
        $size->name = $request->name;
        $size->sort = $request->sort;
        $size->status = $request->status;
        $size->save();

        return redirect()->route('size')->with('message', 'Size add successfully.');
    }

    public function edit(Size $size) {
        return view('admin.product_manage.size.edit', compact('size'));
    }

    public function editPost(Size $size, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required',
        ]);


        $size->name = $request->name;
        $size->sort = $request->sort;
        $size->status = $request->status;
        $size->save();

        return redirect()->route('size')->with('message', 'Size edit successfully.');
    }
}
