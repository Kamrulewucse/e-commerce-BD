<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FinishedGoods;
use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use function redirect;
use function request;
use function route;
use function view;

class FinishedGoodController extends Controller
{
    public function inventory()
    {
        return view('admin.inventory.all');
    }
    public function inventoryLog(Product $product)
    {
        $warehouses = Warehouse::orderBy('name')->get();
        return view('admin.inventory.details',compact('product','warehouses'));
    }
    public function inventoryLogDatatable() {

        $query = InventoryLog::where('product_id',request('product_id'))
            ->with('type','color','size','product', 'product.category', 'product.subCategory',
                'product.subSubCategory','product.brand','product.unit','warehouse');

        return DataTables::eloquent($query)
            ->addColumn('category', function(InventoryLog $inventoryLog) {
                return $inventoryLog->product->category->name;
            })
            ->addColumn('sub_category', function(InventoryLog $inventoryLog) {
                return $inventoryLog->product->subCategory->name;
            })
            ->addColumn('sub_sub_category', function(InventoryLog $inventoryLog) {
                return $inventoryLog->product->subSubCategory->name;
            })
            ->addColumn('product', function(InventoryLog $inventoryLog) {
                return $inventoryLog->product->name;
            })
            ->addColumn('brand', function(InventoryLog $inventoryLog) {
                return $inventoryLog->brand->name ?? '';
            })
            ->addColumn('unit', function(InventoryLog $inventoryLog) {
                return $inventoryLog->unit->name;
            })
            ->addColumn('warehouse', function(InventoryLog $inventoryLog) {
                return $inventoryLog->warehouse->name;
            })
            ->addColumn('color', function(InventoryLog $inventoryLog) {
                return $inventoryLog->color->name;
            })
            ->addColumn('size', function(InventoryLog $inventoryLog) {
                return $inventoryLog->size->name;
            })
            ->addColumn('type_name', function(InventoryLog $inventoryLog) {
                return $inventoryLog->type->name ?? '';
            })
            ->editColumn('type', function(InventoryLog $inventoryLog) {
                if ($inventoryLog->type == 1)
                    return '<span class="badge badge-success">Finished Goods In</span>';
                elseif ($inventoryLog->type == 2)
                    return '<span class="badge badge-label label-danger">Out</span>';
                elseif ($inventoryLog->type == 3)
                    return '<span class="badge badge-success">Add</span>';
                else
                    return '<span class="badge badge-danger">Return</span>';
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('created_at', 'desc');
            })
            ->rawColumns(['type'])
            ->filter(function ($query) {
                if (request()->has('to_date') && request('to_date') != '' && request()->has('from_date') && request('from_date') != '') {
                    $query->where('date', '>=', request('to_date'));
                    $query->where('date', '<=', request('from_date'));
                }

                if (request()->has('type') && request('type') != '') {
                    $query->where('type', request('type'));
                }
                if (request()->has('warehouse') && request('warehouse') != '') {
                    $query->where('warehouse_id', request('warehouse'));
                }
            })
            ->toJson();
    }

    public function inventoryDatatable() {
        $query = Inventory::with('type','color','size','product', 'product.category', 'product.subCategory', 'product.subSubCategory','product.brand','product.unit','warehouse');
        return DataTables::eloquent($query)
            ->addColumn('action', function(Inventory $inventory) {
                return '<a href="'.route('inventory_log',['product'=>$inventory->product_id]).'" class="btn btn-info btn-sm">Details</a>';
            })
            ->addColumn('category', function(Inventory $inventory) {
                return $inventory->product->category->name ?? '';
            })
            ->addColumn('sub_category', function(Inventory $inventory) {
                return $inventory->product->subCategory->name ?? '';
            })
            ->addColumn('sub_sub_category', function(Inventory $inventory) {
                return $inventory->product->subSubCategory->name ?? '';
            })
            ->addColumn('product', function(Inventory $inventory) {
                return $inventory->product->name ?? '';
            })
            ->addColumn('brand', function(Inventory $inventory) {
                return $inventory->brand->name ?? '';
            })
            ->addColumn('unit', function(Inventory $inventory) {
                return $inventory->product->unit->name ?? '';
            })
            ->addColumn('warehouse', function(Inventory $inventory) {
                return $inventory->warehouse->name ?? '';
            })
            ->addColumn('color', function(Inventory $inventory) {
                return $inventory->color->name ?? '';
            })
            ->addColumn('size', function(Inventory $inventory) {
                return $inventory->size->name ?? '';
            })
            ->addColumn('type', function(Inventory $inventory) {
                return $inventory->type->name ?? '';
            })
            ->addColumn('cost_total', function(Inventory $inventory) {
                return number_format(($inventory->quantity * $inventory->cost_unit_price),2);
            })
            ->addColumn('sale_total', function(Inventory $inventory) {
                return number_format(($inventory->quantity * $inventory->selling_unit_price),2);
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function finishedGoods()
    {
        return view('admin.inventory.finished_goods.all');
    }

    public function finishedGoodsDatatable() {
        $query = FinishedGoods::with('type','color','size','product', 'product.category', 'product.subCategory', 'product.subSubCategory','product.brand','product.unit','warehouse');
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function(FinishedGoods $finishedGoods) {
                return '<a href="#" class="btn btn-info btn-sm">Edit</a>';
            })
            ->addColumn('category', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->product->category->name ?? '';
            })
            ->addColumn('sub_category', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->product->subCategory->name ?? '';
            })
            ->addColumn('sub_sub_category', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->product->subSubCategory->name ?? '';
            })
            ->addColumn('product', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->product->name ?? '';
            })
            ->addColumn('brand', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->brand->name ?? '';
            })
            ->addColumn('unit', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->product->unit->name ?? '';
            })
            ->addColumn('warehouse', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->warehouse->name ?? '';
            })
            ->addColumn('color', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->color->name ?? '';
            })
            ->addColumn('size', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->size->name ?? '';
            })
            ->addColumn('type', function(FinishedGoods $finishedGoods) {
                return $finishedGoods->type->name ?? '';
            })
            ->addColumn('cost_total', function(FinishedGoods $finishedGoods) {
               return number_format(($finishedGoods->quantity * $finishedGoods->cost_unit_price),2);
            })
            ->addColumn('sale_total', function(FinishedGoods $finishedGoods) {
                return number_format(($finishedGoods->quantity * $finishedGoods->selling_unit_price),2);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function finishedGoodsAdd()
    {
        $categories = Category::orderBy('sort')->get();
        $sizes = Size::orderBy('sort')->get();
        $types = Type::orderBy('sort')->get();
        $warehouses = Warehouse::orderBy('name')->get();

        return view('admin.inventory.finished_goods.add',compact('categories',
            'sizes','warehouses','types'));
    }

    public function finishedGoodsAddPost(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'warehouse'=>'required',
            'date'=>'required|date',
            'category.*'=>'required',
            'sub_category.*'=>'required',
            'sub_sub_category.*'=>'required',
            'product.*'=>'required',
            'color.*'=>'required',
            'size.*'=>'required',
            'type.*'=>'required',
            'quantity.*'=>'required|numeric|min:1',
            'cost_price.*'=>'required|numeric|min:1',
            'sale_price.*'=>'required|numeric|min:1',
        ]);
        $counter = 0;
        $total = 0;
        foreach ($request->product as $reqProduct) {
            $product = Product::find($reqProduct);
            $checkInventory = Inventory::orderBy('barcode','desc')
                ->first();

            $sizeCheck = DB::table('product_size')
                ->where('size_id',$request->size[$counter])
                ->where('product_id',$product->id)
                ->first();
            if (!$sizeCheck)
                    $product->sizes()->attach($request->size[$counter]);


            $typeCheck = DB::table('product_type')
                ->where('type_id',$request->type[$counter])
                ->where('product_id',$product->id)
                ->first();
            if (!$typeCheck)
                $product->types()->attach($request->type[$counter]);

            if (!$checkInventory){
                $barcodeGenerate = 1000000;
            }else{
                $barcodeGenerate = $checkInventory->barcode + 1;
            }
            //Add to finished goods
            $finishedGoods = new FinishedGoods();
            $finishedGoods->product_id = $product->id;
            $finishedGoods->unit_id = $product->unit_id;
            $finishedGoods->category_id = $product->category_id;
            $finishedGoods->sub_category_id = $product->sub_category_id;
            $finishedGoods->sub_sub_category_id = $product->sub_sub_category_id;
            $finishedGoods->color_id = $request->color[$counter];
            $finishedGoods->size_id = $request->size[$counter];
            $finishedGoods->type_id = $request->type[$counter];
            $finishedGoods->quantity = $request->quantity[$counter];
            $finishedGoods->cost_unit_price = $request->cost_price[$counter];
            $finishedGoods->avg_unit_price = $request->cost_price[$counter];
            $finishedGoods->selling_unit_price = $request->sale_price[$counter];
            $finishedGoods->warehouse_id = $request->warehouse;
            $finishedGoods->date = $request->date;
            $finishedGoods->save();

            $existInventory = Inventory::where('product_id',$product->id)
                            ->where('size_id',$request->size[$counter])
                            ->where('color_id',$request->color[$counter])
                            ->where('type_id',$request->type[$counter])
                            //->where('warehouse_id',$request->warehouse)
                            ->first();
            if ($existInventory && $request->warehouse == $existInventory->warehouse_id){

                $existInventory->cost_unit_price = $request->cost_price[$counter];
                $existInventory->selling_unit_price = $request->sale_price[$counter];

                $totalQty = $request->quantity[$counter] + $existInventory->quantity;
                $totalPrice = $request->cost_price[$counter] + $existInventory->cost_unit_price;

                $avgPrice = $totalPrice / $totalQty;

                $existInventory->avg_unit_price = $avgPrice;
                $existInventory->save();
                $existInventory->increment('quantity',$request->quantity[$counter]);
            }else{
                // Inventory
                $inventory = new Inventory();
                $inventory->product_id = $product->id;
                $inventory->unit_id = $product->unit_id;
                $inventory->category_id = $product->category_id;
                $inventory->sub_category_id = $product->sub_category_id;
                $inventory->sub_sub_category_id = $product->sub_sub_category_id;
                $inventory->color_id = $request->color[$counter];
                $inventory->type_id = $request->type[$counter];
                $inventory->size_id = $request->size[$counter];
                $inventory->quantity = $request->quantity[$counter];
                $inventory->barcode = $existInventory ? $existInventory->barcode : $barcodeGenerate;
                $inventory->cost_unit_price = $request->cost_price[$counter];
                $inventory->avg_unit_price = $request->cost_price[$counter];
                $inventory->selling_unit_price = $request->sale_price[$counter];
                $inventory->warehouse_id = $request->warehouse;
                $inventory->save();
            }

            // Inventory Log
            $inventoryLog = new InventoryLog();
            $inventoryLog->product_id = $product->id;
            $inventoryLog->unit_id = $product->unit_id;
            $inventoryLog->category_id = $product->category_id;
            $inventoryLog->sub_category_id = $product->sub_category_id;
            $inventoryLog->sub_sub_category_id = $product->sub_sub_category_id;
            $inventoryLog->color_id = $request->color[$counter];
            $inventoryLog->size_id = $request->size[$counter];
            $inventoryLog->type_id = $request->type[$counter];
            $inventoryLog->type = 1;
            $inventoryLog->barcode = $existInventory ? $existInventory->barcode : $barcodeGenerate;
            $inventoryLog->date = $request->date;
            $inventoryLog->warehouse_id = $request->warehouse;
            $inventoryLog->quantity = $request->quantity[$counter];
            $inventoryLog->unit_price = $request->cost_price[$counter];
            $inventoryLog->finished_goods_id = $finishedGoods->id;
            $inventoryLog->save();

            $counter++;
        }
        return redirect()->back()
            ->with('message','Work is completed');
    }
}
