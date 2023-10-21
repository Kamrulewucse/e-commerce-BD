<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreList;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Validation\Rule;

class StoreListController extends Controller
{
    public function index() {

        $storeLists = StoreList::orderBy('sort')->get();
        return view('admin.store_list.all', compact('storeLists'));
    }

    public function add() {
        $maxSort = StoreList::max('sort') + 1;
        return view('admin.store_list.add',compact('maxSort'));
    }

    public function addPost(Request $request) {

        $request->validate([
            'name' => [
                'required','max:255',
                Rule::unique('store_lists')

            ],
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'contact_number' => 'required',
            'service_detail' => 'required',
            'opening_hours' => 'required',
            'closing_days' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $storeList = new StoreList();
        $storeList->name = $request->name;
        $storeList->address = $request->address;
        $storeList->latitude = $request->latitude;
        $storeList->longitude = $request->longitude;
        $storeList->contact_number = $request->contact_number;
        $storeList->service_detail = $request->service_detail;
        $storeList->opening_hours = $request->opening_hours;
        $storeList->closing_days = $request->closing_days;
        $storeList->sort = $request->sort;
        $storeList->status = $request->status;
        $storeList->save();

        return redirect()->route('store_list')->with('message', 'Store add successfully.');
    }

    public function edit(StoreList $storeList) {
        return view('admin.store_list.edit', compact('storeList'));
    }

    public function editPost(StoreList $storeList, Request $request) {

        $request->validate([
            'name' => [
                'required','max:255',
                Rule::unique('store_lists')
                ->ignore($storeList)

            ],
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'contact_number' => 'required',
            'service_detail' => 'required',
            'opening_hours' => 'required',
            'closing_days' => 'required',
            'sort' => 'required|integer|min:1',
            'status' => 'required',

        ]);


        $storeList->name = $request->name;
        $storeList->address = $request->address;
        $storeList->latitude = $request->latitude;
        $storeList->longitude = $request->longitude;
        $storeList->contact_number = $request->contact_number;
        $storeList->service_detail = $request->service_detail;
        $storeList->opening_hours = $request->opening_hours;
        $storeList->closing_days = $request->closing_days;
        $storeList->sort = $request->sort;
        $storeList->status = $request->status;
        $storeList->save();

        return redirect()->route('store_list')->with('message', 'Store edit successfully.');
    }
}
