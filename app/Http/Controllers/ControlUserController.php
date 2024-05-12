<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ControlUserController extends Controller
{
    // Direct Control Users Page
    public function control(){
        $users = User::where('role','user')->paginate(5);
        return view('admin.user.control',compact('users'));
    }

    // Change Role
    public function changeRole(Request $request){
        $update = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($update);
    }

    // Delete
    public function delete(Request $request){
        User::where('id',$request->userId)->delete();
    }

    // Edit Page
    public function editPage($id){
        $user = User::where('id',$id)->first();
        return view('admin.user.edit',compact('user'));
    }

    // Edit Account Info
    public function edit($id, Request $req){
        // Validation
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
        return redirect()->route('user#control');
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
