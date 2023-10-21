<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function index() {
        $collections = Collection::orderBy('sort')->get();
        return view('admin.product_manage.collection.all', compact('collections'));
    }

    public function add() {
        $maxSort = Collection::max('sort') + 1;
        return view('admin.product_manage.collection.add',compact('maxSort'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required',
        ]);

        $collection= new Collection();
        $collection->name = $request->name;
        $collection->sort = $request->sort;
        $collection->status = $request->status;
        $collection->save();

        return redirect()->route('collection')->with('message', 'Collection add successfully.');
    }

    public function edit(Collection $collection) {
        return view('admin.product_manage.collection.edit', compact('collection'));
    }

    public function editPost(Collection $collection, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'status' => 'required',
        ]);


        $collection->name = $request->name;
        $collection->sort = $request->sort;
        $collection->status = $request->status;
        $collection->save();

        return redirect()->route('collection')->with('message', 'Collection edit successfully.');
    }
}
