<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=auth()->user();
        $cartData=cart::with('getProductData')->where('user_id', $user->id)->get();
        $subtotal = 0;
        $shipping = 10;
        $tax = 10; //in percentage
        foreach ($cartData as $value){
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
            $subtotal += $price * $value->quantity;
        }
        $taxAmount = round(($subtotal * $tax) / 100);
        $total = round($subtotal + $shipping + $taxAmount);
        return view('cart', compact('cartData', 'user', 'subtotal', 'shipping', 'tax', 'total', 'taxAmount'));
    }
     
    /**
    * Show the form for creating a new resource.
    */
     
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->except('_token');
        foreach ($requestData['cart'] as $key => $value) {
            if($requestData['cartQty'][$key] < 1) {
                Cart::where('id', $value)->delete();
            } else {
                Cart::where('id', $value)->update(['quantity' => $requestData['cartQty'][$key] ?? 1]);
            }
        }
        Comments::where('user_id', auth()->user()->id)->update(['comment' => $requestData['specialNotes']]);
        return redirect()->back()->with('success', 'Cart has been updated!');
      
        // echo "<pre>";
        // print_r($requestData);
        // exit;
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
