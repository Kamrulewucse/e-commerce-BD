<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index() {
        $warehouses = Warehouse::all();
        return view('admin.warehouse.all', compact('warehouses'));
    }

    public function add() {
        return view('admin.warehouse.add');
    }

    public function addPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->status = $request->status;
        $warehouse->save();

        return redirect()->route('warehouse')->with('message', 'Warehouse add successfully.');
    }

    public function edit(Warehouse $warehouse) {
        return view('admin.warehouse.edit', compact('warehouse'));
    }

    public function editPost(Warehouse $warehouse, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->status = $request->status;
        $warehouse->save();

        return redirect()->route('warehouse')->with('message', 'Warehouse edit successfully.');
    }
}
