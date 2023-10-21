<?php

namespace App\Http\Controllers;

use App\Enumeration\OrderStatus;
use App\Library\PortWallet\Exceptions\InvalidArgumentException;
use App\Library\PortWallet\Exceptions\PortWalletException;
use App\Library\PortWallet\PortWallet;
use App\Library\PortWallet\PortWalletClient;
use App\Models\SaleOrder;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Str;

class OnlinePaymentController extends Controller
{
    static function portWalletMakePayment($order,$address,$productsName)
    {

        $apiKey = config('port_wallet.port_wallet_api_key');
        $apiSecret = config('port_wallet.port_wallet_api_secret');
        PortWallet::setApiMode(config('port_wallet.port_wallet_mode'));
        $portWallet = new PortWalletClient($apiKey, $apiSecret);

        $data = array(
            'order' => array(
                'amount' => $order->due,
                'currency' => 'BDT',
                'redirect_url' => config('port_wallet.port_wallet_redirect_url'),
                'ipn_url' => config('port_wallet.port_wallet_redirect_ipn_url'),
                'reference' => 'ABC123',
                'validity' => 900,
            ),
            'product' => array(
                'name' => Str::limit($productsName, 147, '...'),
                'description' => Str::limit($productsName, 147, '...'),
            ),
            'billing' => array(
                'customer' => array(
                    'name' => $order->customer->name,
                    'email' => $order->customer->email,
                    'phone' =>  $order->customer->mobile_no ?? $order->mobile_no,
                    'address' => array(
                        'street' => $address->apartment_details.' ,'.$address->area.' ,'.$address->delivery_address,
                        'city' => $address->city->name ?? 'City',
                        'state' => $address->state->name ?? 'State',
                        'zipcode' => 1212,
                        'country' => $address->country->sortname ?? 'BD',
                    ),
                ),
            ),
            'discount' => array(
                'enable' => 1,
                'codes' => array(
                    0 => 'Bengal 1',
                    1 => 'Bengal 2',
                ),
            ),
            'emi' => [
                'enable' => 1,
                'tenures' => [],
            ]
        );

        try {
            $invoice = $portWallet->invoice->create($data);
            $paymentUrl = $invoice->getPaymentUrl();
            $order->invoice_id = $invoice->invoice_id;
            $order->save();
            Cart::clear();
            return response()->json([
                'success' => true,
                'redirect_url' => $paymentUrl
            ]);
        } catch (InvalidArgumentException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ]);
        }catch (PortWalletException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function portWalletPayment(Request $request)
    {

        $order = SaleOrder::where('invoice_id', $request->invoice)->first();
        $order->transaction_id = $request->transaction_id;
        //$order->invoice_id = $request->invoice;
        $order->due = $request->status != 'REJECTED' ? 0 : $order->due;
        $order->paid = $request->status != 'REJECTED' ? $order->due : 0;
        $order->status = $request->status != 'REJECTED' ? OrderStatus::$PROCESSING : OrderStatus::$PROCESSING;
        $order->payment_status = $request->status;
        $order->save();

        return view('frontend.order_complete', compact('order'));
    }
}
