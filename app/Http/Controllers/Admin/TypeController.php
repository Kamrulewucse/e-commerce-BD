<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    public function index() {
        $types = Type::orderBy('sort')->get();
        return view('admin.product_manage.type.all', compact('types'));
    }

    public function add() {
        $maxSort = Type::max('sort') + 1;
        return view('admin.product_manage.type.add',compact('maxSort'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required',
        ]);

        $type = new Type();
        $type->name = $request->name;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('type')->with('message', 'Type add successfully.');
    }

    public function edit(Type $type) {
        return view('admin.product_manage.type.edit', compact('type'));
    }

    public function editPost(Type $type, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required',
        ]);


        $type->name = $request->name;
        $type->sort = $request->sort;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('type')->with('message', 'Type edit successfully.');
    }
}
