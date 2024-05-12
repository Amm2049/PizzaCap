<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Direct Order Page
    public function listPage(){
        $orders = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->get();
        return view('admin.order.list',compact('orders'));
    }

    // Ajax Sort Orders
    public function sortOrder(Request $request){
        $orders = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id');

        if ( $request->status == 'all') {
            $orders = $orders->get();
        } else {
            $orders = $orders->where('orders.status', $request->status)->get();
        }

        return response()->json($orders,200);
    }

    // Change Order
    public function changeOrder(Request $request){
        Order::where('id', $request->orderId )->update([
            'status' => $request->status
        ]);
    }

    // Detail Order
    public function detailOrder($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = orderList::select('order_lists.*','users.name as user_name','products.name as pizza_name','products.image as pizza_image')
        ->leftJoin('users','order_lists.user_id','users.id')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->where('order_lists.order_code',$orderCode)
        ->get();
        return view('admin.order.detail',compact('orderList','order'));
    }
}
