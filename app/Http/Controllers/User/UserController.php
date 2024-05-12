<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Home Page
    public function homePage(){
        $pizzas = Product::get();
        $catagories = Catagory::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home.home',compact('pizzas','catagories','cart','orders'));
    }

    // Filter Pizza
    public function filter($catagoryId){
        $pizzas = Product::where('catagory_id',$catagoryId)->orderBy('created_at','desc')->get();
        $catagories = Catagory::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home.home',compact('pizzas','catagories','cart','orders'));
    }

    // Pizza Detail
    public function pizzaDetail($pizzaId){
        $pizzaChosen = Product::where('id',$pizzaId)->first();
        $pizzaAll = Product::get();
        return view('user.home.pizzaDetail',compact('pizzaChosen','pizzaAll'));
    }

    // Cart List Page
    public function cartListPage(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','carts.product_id','products.id')
        ->where('carts.user_id',Auth::user()->id)
        ->get();
        // dd($cartList->toArray());

        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->quantity;
        }
        return view('user.cart.list',compact('cartList','totalPrice'));
    }

    // Ordered items page
    public function ordersPage(){
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.order.orderPage',compact('orders'));
    }

    // Password Page
    public function passwordPage(){
        return view('user.profile.password');
    }

    // Change Password
    public function password(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $db_password = $user->password;

        $clientOldPassword = $request->oldPassword;
        $clientNewPassword = $request->newPassword;

        if (Hash::check($clientOldPassword, $db_password)) {

            $data = ['password' => Hash::make($clientNewPassword)];
            User::where('id', Auth::user()->id)->update($data);

            return back()->with(['match' => 'Successfully changed password!']);
        }
        return back()->with(['notMatch' => 'Incorrect current password!']);
    }

    // User Account Page
    public function accountPage(){
        return view('user.profile.account');
    }

    // Edit User Account
    public function editAccount($id, Request $req){
        $this->accountInfoValidation($req);
        $data = $this->getUserData($req);

        if($req->hasFile('image')){
            $db_image = User::where('id',$id)->first();
            $db_image = $db_image->image;

            if($db_image!= null){
                Storage::delete('public/' . $db_image);
            }

            $fileName = uniqid() . $req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/' . $fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['success'=>'   Successfully Updated ! Now you can go back to previous page.']);
    }



    // Private Functions

    // Validation Password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:7',
            'newPassword' => 'required|min:7',
            'confirmPassword' => 'required|min:7|same:newPassword'
        ])->validate();
    }

    // Validation Account Info
    private function accountInfoValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,png,jpeg'
        ])->validate();
    }

    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
    }
}
