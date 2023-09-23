<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = order::with('customerData')->get();
        return view('admin.orders_list', compact('orders'));
    }

    public function changeOrderStatus(Request $request, $id)
    {
        order::where('id', $id)->update(['status' => $request->status ?? null]);
        return redirect()->back()->with('success', 'Order Status Changed Successfully!');
    }

    public function getLineItems(Request $request, $id)
    {
        $orderData = order::where('id', $id)->with('lineitemsData')->first();
        return view('admin.lineitems_list', compact('orderData'));
    }
}
