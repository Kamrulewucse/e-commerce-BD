<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    public function index() {
        $units = Unit::orderBy('name')->get();
        return view('admin.product_manage.unit.all', compact('units'));
    }

    public function add() {
        return view('admin.product_manage.unit.add');
    }

    public function addPost(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255|unique:units',
            'status' => 'required',
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->status = $request->status;
        $unit->save();

        return redirect()->route('unit')->with('message', 'Unit add successfully.');
    }

    public function edit(Unit $unit) {
        return view('admin.product_manage.unit.edit', compact('unit'));
    }

    public function editPost(Unit $unit, Request $request) {
        $request->validate([
            'name' =>  [
                'required','string','max:255',
                Rule::unique('units')
                    ->ignore($unit)
                    ->where('name', $request->name)
            ],
            'status' => 'required'
        ]);

        $unit->name = $request->name;
        $unit->status = $request->status;
        $unit->save();

        return redirect()->route('unit')->with('message', 'Unit edit successfully.');
    }
}
