<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Cash;
use App\Models\MobileBanking;
use App\Models\PurchaseInventory;
use App\Models\PurchaseInventoryLog;
use App\Models\PurchaseOrder;
use App\Models\ProductPurchaseOrder;
use App\Models\PurchasePayment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\TransactionLog;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;
use SakibRahaman\DecimalToWords\DecimalToWords;
use Yajra\DataTables\Facades\DataTables;


class PurchaseController extends Controller
{
    public function purchaseOrder() {
        $suppliers = Supplier::where('status', 1)->orderBy('name')->get();
        $warehouses = Warehouse::where('status', 1)->orderBy('name')->get();
        $categories = Category::where('status',1)->get();

        return view('admin.purchase.purchase_order.create', compact('suppliers',
            'warehouses','categories'));
    }

    public function purchaseOrderPost(Request $request) {

        $request->validate([
            'supplier' => 'required',
            'warehouse' => 'required',
            'date' => 'required|date',
            'category.*' => 'required',
            'subcategory.*' => 'required',
            'sub_sub_category.*' => 'required',
            'product.*' => 'required',
            'quantity.*' => 'required|numeric|min:.1',
            'unit_price.*' => 'required|numeric|min:1',
            'selling_discount.*' => 'required|numeric|min:0',
            'selling_price.*' => 'required|numeric|min:1',
        ]);

        $order = new PurchaseOrder();
        $order->order_no = rand(10000000, 99999999);
        $order->supplier_id = $request->supplier;
        $order->warehouse_id = $request->warehouse;
        $order->date = $request->date;
        $order->total = 0;
        $order->paid = 0;
        $order->due = 0;
        $order->save();

        $counter = 0;
        $total = 0;
        foreach ($request->product as $reqProduct) {

            $product = Product::where('id',$reqProduct)->first();

            $order->products()->attach($reqProduct, [
                'name' => $product->name,
                'category_id' => $product->category_id,
                'sub_category_id' => $product->sub_category_id,
                'sub_sub_category_id' => $product->sub_sub_category_id,
                'quantity' => $request->quantity[$counter],
                'unit_price' => $request->unit_price[$counter],
                'selling_discount' => $request->selling_discount[$counter],
                'selling_price' => $request->selling_price[$counter],
                'total' => $request->quantity[$counter] * $request->unit_price[$counter],
            ]);

            $total += $request->quantity[$counter] * $request->unit_price[$counter];

            $order->total = $total;
            $order->due = $total;
            $order->save();

            $checkInventory = PurchaseInventory::where('warehouse_id',$request->warehouse)
                        ->where('product_id',$product->id)->first();

            if ($checkInventory){

                $totalInventory = $checkInventory->quantity *  $checkInventory->avg_unit_price;
                $totalQty = $request->quantity[$counter] + $checkInventory->quantity;
                $totalInventoryNPurchase = $totalInventory + $total;
                $avgPrice = $totalInventoryNPurchase / $totalQty;

                $checkInventory->increment('quantity',$request->quantity[$counter]);
                $checkInventory->avg_unit_price = $avgPrice;
                $checkInventory->unit_price = $request->unit_price[$counter];
                $checkInventory->discount = $request->selling_discount[$counter];
                $checkInventory->selling_price = $request->selling_price[$counter];
                $checkInventory->save();

            }else{
                // Inventory
                $inventory = new PurchaseInventory();
                $inventory->category_id = $product->category_id;
                $inventory->sub_category_id = $product->sub_category_id;
                $inventory->sub_sub_category_id = $product->sub_sub_category_id;
                $inventory->product_id = $product->id;
                $inventory->quantity = $request->quantity[$counter];
                $inventory->unit_price = $request->unit_price[$counter];
                $inventory->discount = $request->selling_discount[$counter];
                $inventory->selling_price = $request->selling_price[$counter];
                $inventory->avg_unit_price = $request->unit_price[$counter];
                $inventory->warehouse_id = $request->warehouse;
                $inventory->save();
            }


            // Inventory Log
            $inventoryLog = new PurchaseInventoryLog();
            $inventoryLog->category_id = $product->category_id;
            $inventoryLog->sub_category_id = $product->sub_category_id;
            $inventoryLog->sub_sub_category_id = $product->sub_sub_category_id;
            $inventoryLog->product_id = $product->id;
            $inventoryLog->type = 1;
            $inventoryLog->date = $request->date;
            $inventoryLog->warehouse_id = $request->warehouse;
            $inventoryLog->quantity = $request->quantity[$counter];
            $inventoryLog->unit_price = $request->unit_price[$counter];
            $inventoryLog->supplier_id = $request->supplier;
            $inventoryLog->purchase_order_id = $order->id;
            $inventoryLog->save();
            $counter++;
        }

        return redirect()->route('purchase_receipt.details', ['order' => $order->id]);
    }

    public function purchaseReceiptEdit(PurchaseOrder $order) {
        $suppliers = Supplier::where('status', 1)->orderBy('name')->get();
        $warehouses = Warehouse::where('status', 1)->orderBy('name')->get();
        $categories = Category::where('status',1)->get();

        return view('admin.purchase.receipt.edit', compact('order', 'suppliers',
            'warehouses', 'categories'));
    }
    public function purchaseReceiptEditPost(PurchaseOrder $order, Request $request) {

        $request->validate([
            'supplier' => 'required',
            'warehouse' => 'required',
            'date' => 'required|date',
            'category.*' => 'required',
            'subcategory.*' => 'required',
            'sub_sub_category.*' => 'required',
            'product.*' => 'required',
            'quantity.*' => 'required|numeric|min:.1',
            'unit_price.*' => 'required|numeric|min:1',
            'selling_discount.*' => 'required|numeric|min:0',
            'selling_price.*' => 'required|numeric|min:1',
        ]);

        $previousProductsId = [];

        foreach ($order->products as $product){
            $previousProductsId[] = $product->id;
        }

        $counter = 0;
        $total = 0;
        foreach ($request->product as $reqProduct) {

            if (in_array($reqProduct, $previousProductsId)) {

                // Old Item
                $product = Product::find($request->product[$counter]);

                $purchaseProduct = DB::table('product_purchase_order')
                    ->where('purchase_order_id',$order->id)
                    ->where('product_id', $reqProduct)->first();
                DB::table('product_purchase_order')
                    ->where('purchase_order_id',$order->id)
                    ->where('product_id', $reqProduct)
                    ->update([
                        'product_id' => $request->product[$counter],
                        'category_id' => $request->category[$counter],
                        'sub_category_id' => $request->subcategory[$counter],
                        'sub_sub_category_id' => $request->sub_sub_category[$counter],
                        'name' => $product->name,
                        'quantity' => $request->quantity[$counter],
                        'unit_price' => $request->unit_price[$counter],
                        'selling_discount' => $request->selling_discount[$counter],
                        'selling_price' => $request->selling_price[$counter],
                        'total' => $request->quantity[$counter] * $request->unit_price[$counter],
                    ]);
                $total += $request->quantity[$counter] * $request->unit_price[$counter];

                // Inventory
                $checkInventory = PurchaseInventory::where('warehouse_id',$request->warehouse)
                    ->where('product_id',$product->id)->first();

                $totalInventory = $checkInventory->quantity *  $checkInventory->avg_unit_price;
                $totalQty = $request->quantity[$counter] + $checkInventory->quantity;
                $totalInventoryNPurchase = $totalInventory + $total;
                $avgPrice = $totalInventoryNPurchase / $totalQty;

                $inventory = PurchaseInventory::where('warehouse_id',$request->warehouse)
                        ->where('product_id', $reqProduct)->first();

                $inventory->product_id = $product->id;
                $inventory->category_id = $request->category[$counter];
                $inventory->sub_category_id = $request->subcategory[$counter];
                $inventory->sub_sub_category_id = $request->sub_sub_category[$counter];
                $inventory->quantity = $request->quantity[$counter];
                $inventory->unit_price = $request->unit_price[$counter];
                $inventory->discount = $request->selling_discount[$counter];
                $inventory->selling_price = $request->selling_price[$counter];
                $inventory->avg_unit_price = $avgPrice;
                $inventory->warehouse_id = $request->warehouse;
                $inventory->save();

                if ($request->quantity[$counter] != $purchaseProduct->quantity) {

                    $inventoryLog = new PurchaseInventoryLog();
                    $inventoryLog->product_id = $product->id;
                    $inventoryLog->category_id = $request->category[$counter];
                    $inventoryLog->sub_category_id = $request->subcategory[$counter];
                    $inventoryLog->sub_sub_category_id = $request->sub_sub_category[$counter];

                    if ($request->quantity[$counter] > $purchaseProduct->quantity) {
                        $inventoryLog->type = 3;
                        $inventoryLog->quantity = $request->quantity[$counter] - $purchaseProduct->quantity;
                    } else {
                        $inventoryLog->type = 4;
                        $inventoryLog->quantity = $purchaseProduct->quantity - $request->quantity[$counter];
                    }

                    $inventoryLog->date = date('Y-m-d');
                    $inventoryLog->warehouse_id = $request->warehouse;
                    $inventoryLog->unit_price = $request->unit_price[$counter];
                    $inventoryLog->supplier_id = $request->supplier;
                    $inventoryLog->purchase_order_id = $order->id;
                    $inventoryLog->save();

                }

                if (($key = array_search($reqProduct, $previousProductsId)) !== false) {
                    unset($previousProductsId[$key]);
                }
            } else {

                // New Item
                $product = Product::find($request->product[$counter]);

                $order->products()->attach($reqProduct, [
                    'name' => $product->name,
                    'category_id' => $product->category_id,
                    'sub_category_id' => $product->sub_category_id,
                    'sub_sub_category_id' => $product->sub_sub_category_id,
                    'quantity' => $request->quantity[$counter],
                    'unit_price' => $request->unit_price[$counter],
                    'selling_discount' => $request->selling_discount[$counter],
                    'selling_price' => $request->selling_price[$counter],
                    'total' => $request->quantity[$counter] * $request->unit_price[$counter],
                ]);

                $checkInventory = PurchaseInventory::where('warehouse_id',$request->warehouse)
                    ->where('product_id',$product->id)->first();

                if ($checkInventory){
                    $totalInventory = $checkInventory->quantity *  $checkInventory->avg_unit_price;
                    $totalQty = $request->quantity[$counter] + $checkInventory->quantity;
                    $totalInventoryNPurchase = $totalInventory + $total;
                    $avgPrice = $totalInventoryNPurchase / $totalQty;

                    $checkInventory->increment('quantity',$request->quantity[$counter]);
                    $checkInventory->avg_unit_price = $avgPrice;
                    $checkInventory->unit_price = $request->unit_price[$counter];
                    $checkInventory->discount = $request->selling_discount[$counter];
                    $checkInventory->selling_price = $request->selling_price[$counter];
                    $checkInventory->save();

                }else{
                    // Inventory
                    $inventory = new PurchaseInventory();
                    $inventory->category_id = $product->category_id;
                    $inventory->sub_category_id = $product->sub_category_id;
                    $inventory->sub_sub_category_id = $product->sub_sub_category_id;
                    $inventory->product_id = $product->id;
                    $inventory->quantity = $request->quantity[$counter];
                    $inventory->unit_price = $request->unit_price[$counter];
                    $inventory->discount = $request->selling_discount[$counter];
                    $inventory->selling_price = $request->selling_price[$counter];
                    $inventory->avg_unit_price = $request->unit_price[$counter];
                    $inventory->warehouse_id = $request->warehouse;
                    $inventory->save();
                }
                // Inventory Log
                $inventoryLog = new PurchaseInventoryLog();
                $inventoryLog->category_id = $product->category_id;
                $inventoryLog->sub_category_id = $product->sub_category_id;
                $inventoryLog->sub_sub_category_id = $product->sub_sub_category_id;
                $inventoryLog->product_id = $product->id;
                $inventoryLog->type = 1;
                $inventoryLog->date = $request->date;
                $inventoryLog->warehouse_id = $request->warehouse;
                $inventoryLog->quantity = $request->quantity[$counter];
                $inventoryLog->unit_price = $request->unit_price[$counter];
                $inventoryLog->supplier_id = $request->supplier;
                $inventoryLog->purchase_order_id = $order->id;
                $inventoryLog->save();

                $total += $request->quantity[$counter] * $request->unit_price[$counter];

            }

            $counter++;
        }

        // Delete items
        foreach ($previousProductsId as $reqProduct) {
            $purchaseProduct = DB::table('product_purchase_order')
                ->where('purchase_order_id', $order->id)
                ->where('product_id', $reqProduct)->first();

            $inventory = PurchaseInventory::where('product_id', $reqProduct)
                ->where('product_id', $purchaseProduct->product_id)->first();

            $inventoryLog = new PurchaseInventoryLog();
            $inventoryLog->product_id = $purchaseProduct->product_id;
            $inventoryLog->category_id = $purchaseProduct->category_id;
            $inventoryLog->sub_category_id = $purchaseProduct->sub_category_id;
            $inventoryLog->sub_sub_category_id = $purchaseProduct->sub_sub_category_id;
            $inventoryLog->type = 4;
            $inventoryLog->quantity = $purchaseProduct->quantity;
            $inventoryLog->date = date('Y-m-d');
            $inventoryLog->warehouse_id = $request->warehouse;
            $inventoryLog->unit_price = $purchaseProduct->unit_price;
            $inventoryLog->supplier_id = $request->supplier;
            $inventoryLog->purchase_order_id = $order->id;
            $inventoryLog->save();

            $inventory->delete();

            DB::table('product_purchase_order')
                ->where('purchase_order_id', $order->id)
                ->where('product_id', $reqProduct)->delete();

        }

        // Update Order
        $order->supplier_id = $request->supplier;
        $order->warehouse_id = $request->warehouse;
        $order->date = $request->date;

        if ($total > $order->total) {
            if ($order->refund > 0) {
                if ($order->refund > $total - $order->total) {
                    $order->decrement('refund', $total - $order->total);
                } else  {
                    $previousRefund = $order->refund;
                    $order->decrement('refund', $order->refund);
                    $order->increment('due', $total - $order->total- $previousRefund);
                }
            } else {
                $order->increment('due', $total - $order->total);
            }

        } elseif($order->total > $total) {
            if ($order->due >= 0) {
                if ($order->due > $order->total - $total) {
                    $order->decrement('due', $order->total - $total);
                } else {
                    $previousDue = $order->due;
                    $order->decrement('due', $order->due);
                    $order->increment('refund', $order->total - $total - $previousDue);
                }
            } else {
                $order->increment('refund', $order->total - $total);
            }
        }

        $order->total = $total;
        $order->save();


        return redirect()->route('purchase_receipt.details', ['order' => $order->id]);
    }

    public function purchaseReceipt() {
        return view('admin.purchase.receipt.all');
    }

    public function purchaseReceiptDetails(PurchaseOrder $order) {
        return view('admin.purchase.receipt.details', compact('order'));
    }

    public function purchaseReceiptPrint(PurchaseOrder $order) {
        return view('admin.purchase.receipt.print', compact('order'));
    }

    public function barCode(PurchaseOrder $order) {
        return view('admin.purchase.receipt.qr_code', compact('order'));
    }

    public function barCodePrint(PurchaseOrder $order) {

        return view('admin.purchase.receipt.qr_code_print', compact('order'));
    }


    public function allBarCodePrint(PurchaseOrder $order) {

        return view('admin.purchase.receipt.all_qr_code_print', compact('order'));
    }


    public function barSingleCodePrint($order) {
        $product = ProductPurchaseOrder::with('product')->where('id',$order)->first();
        return view('admin.purchase.receipt.qr_code_print', compact('product'));
    }

    public function supplierPayment() {
        $suppliers = Supplier::all();
        $banks = Bank::where('status', 1)->orderBy('name')->get();
        return view('admin.purchase.supplier_payment.all', compact('suppliers', 'banks'));
    }

    public function supplierPaymentGetOrders(Request $request) {
        $orders = PurchaseOrder::where('supplier_id', $request->supplierId)
            ->where('due', '>', 0)
            ->orderBy('order_no')
            ->get()->toArray();

        return response()->json($orders);
    }

    public function supplierPaymentGetRefundOrders(Request $request) {
        $orders = PurchaseOrder::where('supplier_id', $request->supplierId)
            ->where('refund', '>', 0)
            ->orderBy('order_no')
            ->get()->toArray();

        return response()->json($orders);
    }

    public function supplierPaymentOrderDetails(Request $request) {
        $order = PurchaseOrder::where('id', $request->orderId)
            ->first()->toArray();

        return response()->json($order);
    }

    public function makePayment(Request $request) {
        $rules = [
            'order' => 'required',
            'payment_type' => 'required',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ];

        if ($request->payment_type == '2') {
            $rules['bank'] = 'required';
            $rules['branch'] = 'required';
            $rules['account'] = 'required';
            $rules['cheque_no'] = 'nullable|string|max:255';
            $rules['cheque_image'] = 'nullable|image';
        }

        if ($request->order != '') {
            $order = PurchaseOrder::find($request->order);
            $rules['amount'] = 'required|numeric|min:0|max:'.$order->due;
        }

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request) {
            if ($request->payment_type == 1) {
                $cash = Cash::first();

                if ($request->amount > $cash->amount)
                    $validator->errors()->add('amount', 'Insufficient balance.');
            } else {
                if ($request->account != '') {
                    $account = BankAccount::find($request->account);

                    if ($request->amount > $account->balance)
                        $validator->errors()->add('amount', 'Insufficient balance.');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $order = PurchaseOrder::find($request->order);

        if ($request->payment_type == 1 || $request->payment_type == 3) {
            $payment = new PurchasePayment();
            $payment->purchase_order_id = $order->id;
            $payment->transaction_method = $request->payment_type;
            $payment->amount = $request->amount;
            $payment->date = $request->date;
            $payment->note = $request->note;
            $payment->save();

            if ($request->payment_type == 1)
                Cash::first()->decrement('amount', $request->amount);
            else
                MobileBanking::first()->decrement('amount', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Paid to '.$order->supplier->name.' for '.$order->order_no;
            $log->transaction_type = 3;
            $log->transaction_method = $request->payment_type;
            $log->account_head_type_id = 1;
            $log->account_head_sub_type_id = 1;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->purchase_payment_id = $payment->id;
            $log->save();

        } else {
            $image = 'img/no_image.png';

            if ($request->cheque_image) {
                // Upload Image
                $file = $request->file('cheque_image');
                $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/purchase_payment_cheque';
                $file->move($destinationPath, $filename);

                $image = 'uploads/purchase_payment_cheque/'.$filename;
            }

            $payment = new PurchasePayment();
            $payment->purchase_order_id = $order->id;
            $payment->transaction_method = 2;
            $payment->bank_id = $request->bank;
            $payment->branch_id = $request->branch;
            $payment->bank_account_id = $request->account;
            $payment->cheque_no = $request->cheque_no;
            $payment->cheque_image = $image;
            $payment->amount = $request->amount;
            $payment->date = $request->date;
            $payment->note = $request->note;
            $payment->save();

            BankAccount::find($request->account)->decrement('balance', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Paid to '.$order->supplier->name.' for '.$order->order_no;
            $log->transaction_type = 3;
            $log->transaction_method = 2;
            $log->account_head_type_id = 1;
            $log->account_head_sub_type_id = 1;
            $log->bank_id = $request->bank;
            $log->branch_id = $request->branch;
            $log->bank_account_id = $request->account;
            $log->cheque_no = $request->cheque_no;
            $log->cheque_image = $image;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->purchase_payment_id = $payment->id;
            $log->save();
        }

        $order->increment('paid', $request->amount);
        $order->decrement('due', $request->amount);

        return response()->json(['success' => true, 'message' => 'Payment has been completed.', 'redirect_url' => route('purchase_receipt.payment_details', ['payment' => $payment->id])]);
    }

    public function makeRefund(Request $request) {
        $rules = [
            'order' => 'required',
            'payment_type' => 'required',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ];

        if ($request->payment_type == '2') {
            $rules['bank'] = 'required';
            $rules['branch'] = 'required';
            $rules['account'] = 'required';
            $rules['cheque_no'] = 'nullable|string|max:255';
            $rules['cheque_image'] = 'nullable|image';
        }

        if ($request->order != '') {
            $order = PurchaseOrder::find($request->order);
            $rules['amount'] = 'required|numeric|min:0|max:'.$order->refund;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $order = PurchaseOrder::find($request->order);

        if ($request->payment_type == 1 || $request->payment_type == 3) {
            $payment = new PurchasePayment();
            $payment->purchase_order_id = $order->id;
            $payment->type = 2;
            $payment->transaction_method = $request->payment_type;
            $payment->amount = $request->amount;
            $payment->date = $request->date;
            $payment->note = $request->note;
            $payment->save();

            if ($request->payment_type == 1)
                Cash::first()->increment('amount', $request->amount);
            else
                MobileBanking::first()->increment('amount', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Refund from '.$order->supplier->name.' for '.$order->order_no;
            $log->transaction_type = 5;
            $log->transaction_method = $request->payment_type;
            $log->account_head_type_id = 7;
            $log->account_head_sub_type_id = 7;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->purchase_payment_id = $payment->id;
            $log->save();

        } else {
            $image = 'img/no_image.png';

            if ($request->cheque_image) {
                // Upload Image
                $file = $request->file('cheque_image');
                $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/purchase_payment_cheque';
                $file->move($destinationPath, $filename);

                $image = 'uploads/purchase_payment_cheque/'.$filename;
            }

            $payment = new PurchasePayment();
            $payment->purchase_order_id = $order->id;
            $payment->type = 2;
            $payment->transaction_method = 2;
            $payment->bank_id = $request->bank;
            $payment->branch_id = $request->branch;
            $payment->bank_account_id = $request->account;
            $payment->cheque_no = $request->cheque_no;
            $payment->cheque_image = $image;
            $payment->amount = $request->amount;
            $payment->date = $request->date;
            $payment->note = $request->note;
            $payment->save();

            BankAccount::find($request->account)->increment('balance', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Refund from '.$order->supplier->name.' for '.$order->order_no;
            $log->transaction_type = 5;
            $log->transaction_method = 2;
            $log->account_head_type_id = 7;
            $log->account_head_sub_type_id = 7;
            $log->bank_id = $request->bank;
            $log->branch_id = $request->branch;
            $log->bank_account_id = $request->account;
            $log->cheque_no = $request->cheque_no;
            $log->cheque_image = $image;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->purchase_payment_id = $payment->id;
            $log->save();
        }

        $order->decrement('refund', $request->amount);

        return response()->json(['success' => true, 'message' => 'Refund has been completed.', 'redirect_url' => route('purchase_receipt.payment_details', ['payment' => $payment->id])]);
    }

    public function purchasePaymentDetails(PurchasePayment $payment) {
        $payment->amount_in_word = DecimalToWords::convert($payment->amount,'Taka',
            'Poisa');
        return view('admin.purchase.receipt.payment_details', compact('payment'));
    }

    public function purchasePaymentPrint(PurchasePayment $payment) {
        $payment->amount_in_word = DecimalToWords::convert($payment->amount,'Taka',
            'Poisa');
        return view('admin.purchase.receipt.payment_print', compact('payment'));
    }

    public function purchaseInventory() {
        return view('admin.purchase.inventory.all');
    }

    public function purchaseInventoryDetails(Product $product, Warehouse $warehouse) {
        return view('admin.purchase.inventory.details', compact('product', 'warehouse'));
    }

    public function purchaseInventoryBarCode(Product $product, Warehouse $warehouse) {
        $rows = PurchaseInventory::with('product')
            ->where('product_id', $product->id)
            ->where('warehouse_id', $warehouse->id)
            ->where('quantity', '>', 0)->get();

        return view('admin.purchase.inventory.qr_code', compact('rows', 'product', 'warehouse'));
    }


    public function checkDeleteStatus(Request $request) {
        $inventory = PurchaseInventory::where('serial_no', $request->serial)->first();

        if ($inventory) {
            if ($inventory->quantity > 0) {
                return response()->json(['success' => true, 'message' => 'This product not sold.']);
            } else {
                return response()->json(['success' => false, 'message' => 'This product already sold.']);
            }
        }

        return response()->json(['success' => true, 'message' => 'Serial not found.']);
    }

    public function purchaseProductJson(Request $request) {
        if (!$request->searchTerm) {
            $products = PurchaseProduct::where('status', 1)->orderBy('name')->limit(10)->get();
        } else {
            $products = PurchaseProduct::where('status', 1)->where('name', 'like', '%'.$request->searchTerm.'%')->orderBy('name')->limit(10)->get();
        }

        $data = array();

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'text' => $product->name
            ];
        }

        echo json_encode($data);
    }

    public function purchaseReceiptDatatable() {
        $query = PurchaseOrder::with('supplier');

        return DataTables::eloquent($query)
            ->addColumn('supplier', function(PurchaseOrder $order) {
                return $order->supplier->name;
            })
            ->addColumn('action', function(PurchaseOrder $order) {
                $btn = '<a href="'.route('purchase_receipt.details', ['order' => $order->id]).'" class="btn btn-primary btn-sm">View</a> <a href="'.route('purchase_receipt.qr_code', ['order' => $order->id]).'" class="btn btn-primary btn-sm">BarCode</a> ';
                $btn .= '<a href="'.route('purchase_receipt.edit', $order->id).'" class="btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })

//            ->filterColumn('products_code', function ($query, $keyword) {
//                $order_products = PurchaseProduct::where('code','like', '%'.$keyword.'%')->pluck('id');
//                $order_ids = PurchaseOrderPurchaseProduct::whereIn('purchase_product_id', $order_products)->distinct('purchase_order_id')->pluck('purchase_order_id');
//                return $query->whereIn('id', $order_ids);
//            })
            ->editColumn('date', function(PurchaseOrder $order) {
                return $order->date->format('j F, Y');
            })
            ->editColumn('total', function(PurchaseOrder $order) {
                return '৳'.number_format($order->total, 2);
            })
            ->editColumn('paid', function(PurchaseOrder $order) {
                return '৳'.number_format($order->paid, 2);
            })
            ->editColumn('due', function(PurchaseOrder $order) {
                return '৳'.number_format($order->due, 2);
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('created_at', 'desc');
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function qrProduct(){
        return view('purchase.inventory.qr_product');
    }
    public function qrProductDatatable(){
              $query = PurchaseInventory::with('product', 'category', 'subcategory','subSubCategory','brand');

               return DataTables::eloquent($query)
            ->addColumn('product', function(PurchaseInventory $inventory) {
                return $inventory->product->name;
            })

            ->addColumn('category', function(PurchaseInventory $inventory) {
                return $inventory->category->name;
            })
            ->addColumn('subcategory', function(PurchaseInventory $inventory) {
                return $inventory->subcategory->name;
            })
           ->addColumn('subSubCategory', function(PurchaseInventory $inventory) {
               return $inventory->subSubCategory->name;
           })
           ->addColumn('brand', function(PurchaseInventory $inventory) {
               return $inventory->brand->name;
           })
           ->addColumn('attributes', function(PurchaseInventory $inventory) {
               return $inventory->color->name.'->'.$inventory->size->name;
           })
            ->addColumn('action', function(PurchaseInventory $inventory) {

                  $purchaseProduct = DB::table('purchase_order_purchase_product')
                        ->where('serial_no',$inventory->serial_no)
                        ->first();

                return '<a target="_blank" href="'.route('purchase_receipt.qr_code_single_print', ['order' => $purchaseProduct->id]).'" class="btn btn-primary btn-sm">BarCode <i class="fa fa-print"></i></a> <a href="'.route('purchase_receipt.edit', ['order' => $purchaseProduct->purchase_order_id]).'" class="btn btn-primary btn-sm">Edit</a>';

            })
            ->editColumn('quantity', function(PurchaseInventory $inventory) {
                return number_format($inventory->quantity, 2);
            })
             ->editColumn('selling_price', function(PurchaseInventory $inventory) {
                return '৳ '.number_format($inventory->selling_price, 2);
            })


            ->rawColumns(['action'])
            ->toJson();
    }
    public function purchaseInventoryDatatable() {
        $query = PurchaseInventory::with('product', 'product.category', 'product.subcategory','product.subSubCategory','warehouse');

        return DataTables::eloquent($query)
            ->addColumn('product', function(PurchaseInventory $inventory) {
                return $inventory->product->name;
            })
            ->editColumn('book_code', function(PurchaseInventory $inventory) {
                return $inventory->product->book_code;
            })
            ->addColumn('category', function(PurchaseInventory $inventory) {
                return $inventory->product->category->name;
            })
            ->editColumn('subcategory', function(PurchaseInventory $inventory) {
                return $inventory->product->subcategory->name;
            })
            ->editColumn('subSubCategory', function(PurchaseInventory $inventory) {
                return $inventory->product->subSubCategory->name;
            })
            ->editColumn('warehouse', function(PurchaseInventory $inventory) {
                return $inventory->warehouse->name;
            })
            ->addColumn('action', function(PurchaseInventory $inventory) {
                return '<a href="'.route('purchase_inventory.details', ['product' => $inventory->product_id, 'warehouse' => $inventory->warehouse->id]).'" class="btn btn-primary btn-sm">Details</a> <a href="'.route('purchase_inventory.qr_code', ['product' => $inventory->product_id, 'warehouse' => $inventory->warehouse->id]).'" class="btn btn-primary btn-sm">Bar Code</a>';

            })
            ->editColumn('quantity', function(PurchaseInventory $inventory) {
                return number_format($inventory->quantity, 2);
            })
            ->editColumn('unit_price', function(PurchaseInventory $inventory) {
                return number_format($inventory->unit_price, 2);
            })
            ->editColumn('avg_unit_price', function(PurchaseInventory $inventory) {
                return number_format($inventory->avg_unit_price, 2);
            })
            ->editColumn('discount', function(PurchaseInventory $inventory) {
                return number_format($inventory->discount, 2).'%';
            })
            ->editColumn('selling_price', function(PurchaseInventory $inventory) {
            return number_format($inventory->selling_price, 2);
            })

            ->rawColumns(['action'])
            ->toJson();
    }

    public function purchaseInventoryDetailsDatatable() {
        $query = PurchaseInventoryLog::where('product_id', request('product_id'))
            ->where('warehouse_id', request('warehouse_id'))
            ->with('product', 'supplier', 'purchaseOrder');

        return DataTables::eloquent($query)
            ->editColumn('date', function(PurchaseInventoryLog $log) {
                return $log->date->format('d-m-Y');
            })
            ->editColumn('type', function(PurchaseInventoryLog $log) {
                if ($log->type == 1)
                    return '<span class="label label-success">In</span>';
                elseif ($log->type == 2)
                    return '<span class="label label-danger">Out</span>';
                elseif ($log->type == 3)
                    return '<span class="label label-success">Add</span>';
                else
                    return '<span class="label label-danger">Return</span>';
            })
            ->editColumn('quantity', function(PurchaseInventoryLog $log) {
                return number_format($log->quantity, 2);
            })
            ->editColumn('avg_unit_price', function(PurchaseInventoryLog $log) {
                return number_format($log->avg_unit_price, 2);
            })
            ->editColumn('selling_price', function(PurchaseInventoryLog $log) {
                return number_format($log->selling_price, 2);
            })
            ->editColumn('last_unit_price', function(PurchaseInventoryLog $log) {
                return number_format($log->last_unit_price, 2);
            })
            ->editColumn('total', function(PurchaseInventoryLog $log) {
                return number_format($log->total, 2);
            })
            ->editColumn('unit_price', function(PurchaseInventoryLog $log) {
                if ($log->unit_price)
                    return '৳'.number_format($log->unit_price, 2);
                else
                    return '';
            })
            ->editColumn('supplier', function(PurchaseInventoryLog $log) {
                if ($log->supplier)
                    return $log->supplier->name;
                else
                    return '';
            })
            ->editColumn('purchase_order', function(PurchaseInventoryLog $log) {
                if ($log->purchaseOrder)
                    return '<a href="'.route('purchase_receipt.details', ['order' => $log->purchaseOrder->id]).'">'.$log->purchaseOrder->order_no.'</a>';
                else
                    return '';
            })

            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('created_at', 'desc');
            })
            ->rawColumns(['type', 'order','purchase_order'])
            ->filter(function ($query) {
                if (request()->has('date') && request('date') != '') {
                    $dates = explode(' - ', request('date'));
                    if (count($dates) == 2) {
                        $query->where('date', '>=', $dates[0]);
                        $query->where('date', '<=', $dates[1]);
                    }
                }

                if (request()->has('type') && request('type') != '') {
                    $query->where('type', request('type'));
                }
            })
            ->toJson();
    }
}
