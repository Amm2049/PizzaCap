<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatagoryController extends Controller
{
    // Direct Catagory List Page
    public function list(){
        // Getting data and showing & When for Searching
        $catagories = Catagory::when(request('key'),function($query){
                $query->where('name','like','%'.request('key').'%');
            })
            ->orderBy('id','desc')
            ->paginate(4);
        return view('admin.catagory.list',compact('catagories'));
    }

    // Direct Catagory Create Page
    public function createPage(){
        return view('admin.catagory.create');
    }

    // Create Catagory
    public function create(Request $request){
        $this->catagoryValidationCheck($request);
        $data = $this->requestCatagoryData($request); // Changing to array
        Catagory::create($data);
        return redirect()->route('catagory#list');
    }

    // Delete Category
    public function delete($id){
        Catagory::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Deleted successfully ...']);
    }

    // Direct Catagory Update Page
    public function updatePage($keyID){
        $catagory = Catagory::where('id',$keyID)->first();
        return view('admin.catagory.update',compact('catagory'));
    }

    //  Update Catagory
    public function update(Request $request){
        $this->catagoryValidationCheck($request);
        $data = $this->requestCatagoryData($request); // Changing to array
        Catagory::where('id', $request->catagoryId)->update($data);
        return redirect()->route('catagory#list');
    }



    // Private Functions ===================================>

    // CatagoryName Validation
    private function catagoryValidationCheck($request){
        Validator::make($request->all(),[
            'catagoryName' => 'required|unique:catagories,name,' . $request->catagoryId
        ])->validate();
    }

    // Changing request data to array for Create
    private function requestCatagoryData($request){
        return [
            'name' => $request->catagoryName
        ];
    }
}
