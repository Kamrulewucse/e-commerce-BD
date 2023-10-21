<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    public function index() {
        $colors = Color::orderBy('sort')->get();

        return view('admin.product_manage.color.all', compact('colors'));
    }

    public function add() {
        $maxSort = Color::max('sort') + 1;
        return view('admin.product_manage.color.add',compact('maxSort'));
    }

    public function addPost(Request $request) {
        $rules = [
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'color_code' => 'required',
            'status' => 'required',
        ];
        if ($request->color_type == 2){
            $rules['color_code_2'] = 'required';
        }
        $request->validate($rules);

        $color = new Color();
        $color->color_type = $request->color_type;
        $color->name = $request->name;
        $color->code = $request->color_code;
        $color->code2 = $request->color_code_2;
        $color->sort = $request->sort;
        $color->status = $request->status;
        $color->save();

        return redirect()->route('color')->with('message', 'Color add successfully.');
    }

    public function edit(Color $color) {

        return view('admin.product_manage.color.edit', compact('color'));
    }

    public function editPost(Color $color, Request $request) {

        $rules = [
            'name' => 'required|string|max:255',
            'sort' => 'required',
            'color_code' => 'required',
            'status' => 'required',
        ];
        if ($request->color_type == 2){
            $rules['color_code_2'] = 'required';
        }
        $request->validate($rules);


        $color->color_type = $request->color_type;
        $color->name = $request->name;
        $color->code = $request->color_code;
        $color->code2 = $request->color_code_2;
        $color->sort = $request->sort;
        $color->status = $request->status;
        $color->save();

        return redirect()->route('color')->with('message', 'Color edit successfully.');
    }
}
