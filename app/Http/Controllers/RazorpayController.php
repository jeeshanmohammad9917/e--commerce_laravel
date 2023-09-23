<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\cart;


class RazorpayController extends Controller
{
    public $api;

    public function __construct($foo = null){

       $this->api = new Api("rzp_test_KQtXcCLUR4Tucv", "S5QeSFSNqPYBpGcNvk1PQ2nh");
    }

    public function formpage(Request $request){
        $user = auth()->user();
        $cartData = Cart::with('getProductData')->where('user_id', $user->id)->get();
        $subtotal = 0;
        $shipping = 10;
        $tax = 10; //in percentage
        $lineItemData = [];
        foreach ($cartData as $value) {
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
            $subtotal += $price * $value->quantity;
        }
        $taxAmount = round(($subtotal * $tax) / 100);
        $total = round($subtotal + $shipping + $taxAmount);
        $orderId= rand(111111 , 999999);
        $orderData = [
            'receipt'         => 'rcptid_11',
            'amount'          => ($total) * 100, // 39900 rupees in paise
            'currency'        => 'INR',
            'notes'        => ['order_Id' => $orderId ]
        ];
        
        // dd($razorpayOrder);
        $razorpayOrder = $this->api->order->create($orderData);
        return view('payment' ,compact('subtotal' ,'shipping' ,'taxAmount' ,'tax','total','razorpayOrder'));
    }
    
    public function success(Request $request){
        $paymentid=$request->get('payment_id');
        $status=$this->api->payment->fetch($paymentid);
        // dd($status);
        $paymentdata=[
                'payment_id' => $status->id,
                'entity' => $status->entity,
                'amount' =>$status->amount ,
                'currency' => $status->currency,
                'status' => $status->status,
                'order_id' => $status->order_id,
                'user_id' => auth()->user()->id,
                'invoice_id' =>$status->invoice_id ,
                'method' =>$status->method ,
                'amount_refunded' =>$status->amount_refunded,
                'refund_status' =>$status->refund_status ,
                'captured' => $status->captured,
                'description' => $status->description,
                'card_id' => $status->card_id,
                'bank' => $status->bank,
                'wallet' =>$status->wallet,
                'vpa' =>$status->vpa,
                'email' => $status->email,
                'contact' =>$status->contact ,
                'notes' => json_encode([
                    'order_id' => isset($status->notes['order_Id']) ? $status->notes['order_Id'] : null,
                    'address' => isset($status->notes['address']) ? $status->notes['address'] : null,
                ]),
                'fee' => $status->fee,
                'tax' => $status->tax,
                'error_code' =>$status->error_code ,
                'error_description' =>$status->error_description ,
                'error_source' => $status->error_source,
                'error_step' =>$status->error_step ,
                'error_reason' => $status->error_reason,
                'acquirer_data' =>json_encode( [
                    'bank_transaction_id'=>isset($status->acquirer_data['bank_transaction_id']) ? $status->acquirer_data['bank_transaction_id'] : null,
                ]),
                'created_at' => $status->created_at,
            ];
        // echo"<pre>";
        // print_r($paymentdata);
        // exit;
        $user=Payment::create($paymentdata);
        
        return redirect()->route('store_order')->with('success', 'Payment successfull');
        // return view('user_order')->with('success','payment successfull');
    }
   
    
}
