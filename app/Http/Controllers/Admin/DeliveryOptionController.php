<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOption;
use Illuminate\Http\Request;

class DeliveryOptionController extends Controller
{
    public function index() {
        $deliveryOptions = DeliveryOption::orderBy('sort')->get();
        return view('admin.delivery_option.all', compact('deliveryOptions'));
    }

    public function add() {
        return view('admin.delivery_option.add');
    }

    public function addPost(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'delivery_duration' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:1',
            'sort' => 'required|integer',
            'status' => 'required',
        ]);

        $deliveryOption = new DeliveryOption();
        $deliveryOption->name = $request->name;
        $deliveryOption->delivery_duration = $request->delivery_duration;
        $deliveryOption->delivery_fee = $request->delivery_fee;
        $deliveryOption->sort = $request->sort;
        $deliveryOption->status = $request->status;
        $deliveryOption->save();

        return redirect()->route('delivery_option')->with('message', 'Delivery option add successfully.');
    }

    public function edit(DeliveryOption $deliveryOption) {
        return view('admin.delivery_option.edit', compact('deliveryOption'));
    }

    public function editPost(DeliveryOption $deliveryOption, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'delivery_duration' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:1',
            'sort' => 'required|integer',
            'status' => 'required',
        ]);

        $deliveryOption->name = $request->name;
        $deliveryOption->delivery_fee = $request->delivery_fee;
        $deliveryOption->delivery_duration = $request->delivery_duration;
        $deliveryOption->sort = $request->sort;
        $deliveryOption->status = $request->status;
        $deliveryOption->save();

        return redirect()->route('delivery_option')->with('message', 'Delivery option edit successfully.');
    }
}
