<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Products List Page
    public function listPage(){
        $pizzas = Product::select('products.*','catagories.name as catagory_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('catagories','products.catagory_id','catagories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(4);
        $pizzas->appends(request()->all());
        return view('admin.product.productList',compact('pizzas'));
    }

    // Products Ctreate Page
    public function createPage(){
        $catagories = Catagory::select('id','name')->get();
        return view('admin.product.productCreate',compact('catagories'));
    }

    // Create
    public function create(Request $request){
        $this->productInfoValidation($request,"create");
        $data = $this->getProductInfo($request);

        $fileName = uniqid() . $request->file('pizzaImage') -> getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#listPage');
    }

    // View
    public function view($id){
        $pizza = Product::select('products.*','catagories.name as catagory_name')
        ->leftJoin('catagories','products.catagory_id','catagories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.productView',compact('pizza'));
    }

    // Update Page
    public function updatePage($id,Request $request){
        $pizza = Product::where('id',$id)->first();
        $catagories = Catagory::get();
        return view('admin.product.productUpdatePage',compact('pizza','catagories'));
    }

    // Update
    public function update(Request $request){
        $this->productInfoValidation($request,"update");
        $data = $this->getProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if ($oldImageName != null) {
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#listPage');
    }

    // Delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return back();
    }




    // Private Functions

    // Validation Product Info
    private function productInfoValidation($request,$action){
        $validationRule = [
            'pizzaName' => 'required|min:5|unique:products,name,' . $request->pizzaId,
            'pizzaDescription' => 'required|min:15',
            'pizzaCatagory' => 'required',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required'
        ];
        $validationRule['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,jpeg,webp,png|file' : 'mimes:jpg,jpeg,webp,png|file';
        Validator::make($request->all(),$validationRule)->validate();
    }

    private function getProductInfo($request){
        return [
            'catagory_id' => $request->pizzaCatagory,
            'name' => $request->pizzaName,
            'price' => $request->pizzaPrice,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }
}
