<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzaSorting(Request $request){
        if ($request->status=='asc') {
            $data = Product::orderBy('created_at','asc')->get();
        } else {
            $data = Product::orderBy('created_at','desc')->get();
        }
        return response()->json($data, 200);
    }

    public function addCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Added to cart successfully.'
        ];

        return response()->json($response, 200);
    }

    // Order
    public function order(Request $request){

        $total = 0;

        foreach ($request->all() as $item) {
            $data = orderList::create($item);
            $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id ,
            'order_code' => $data->order_code ,
            'total_price' => $total + 3000
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    // Clear all cart Items
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // Clear selected cart item
    public function clearCartItem(Request $request){
        logger($request);
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->cartId)
        ->delete();
    }

    // View Count
    public function viewCount(Request $request){
        $pizza = Product::where('id', $request->pizzaId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];

        Product::where('id', $request->pizzaId)->update($viewCount);
    }


    // private functions

    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'quantity' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
