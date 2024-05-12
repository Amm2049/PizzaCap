<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // Create
    public function createData(Request $request){
        $response = Catagory::create([
            'name' => $request->name ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ]);
        return response()->json($response, 200);
    }

    // Read
    public function getData(){
        $products = Product::get();
        return response()->json($products, 200);
    }

    // Update
    public function updateData(Request $request){
        $id = $request->id;
        $name = $request->name;

        $db_source = Catagory::where('id', $id)->first();
        if(isset($db_source)){
            Catagory::where('id', $id)->update([
                'name' => $name
            ]);
            $response = Catagory::where('id', $id)->first();

            return response()->json([ 'status' => 'successful' , 'updated data' => $response ], 200);
        }
        return response()->json([ 'status' => 'failed' , 'message' => 'There is no match category.' ], 500);
    }

    // Delete
    public function deleteData($id){

        $data = Catagory::where('id', $id)->first();

        if(isset($data)){
            Catagory::where('id', $id)->delete();

            return response()->json([ 'status' => 'successful' , 'Deleted Data' => $data ], 200);
        }
        return response()->json([ 'status' => 'failed' , 'message' => 'There is no match category.' ], 500);
    }
}
