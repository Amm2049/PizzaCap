<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Direct Password Change Page
    public function changePasswordPage(){
        return view('admin.profile.password');
    }

    // Change Password
    public function changePassword(Request $request){

        /*
            1. Fields must be filled.
            2. New and confirm passwords must have at least 7 characters.
            3. New and confirm passwords must be the same.
            4. Old password must match to Db_password.
            5. Change password.
        */

        $this->passwordValidationCheck($request);
        // Get data from Db
        $user = User::select('password')->where('id', Auth::user()->id)->first();  // Auth::user()-> id = Current logged in account id
        $db_password = $user->password;

        // Client current password
        $clientOldPassword = $request->oldPassword;
        // Client new password
        $clientNewPassword = $request->newPassword;

        if (Hash::check($clientOldPassword, $db_password)) {

            // Change Password
            $data = ['password' => Hash::make($clientNewPassword)];
            User::where('id', Auth::user()->id)->update($data);

            // Auth::logout; (If you wanna logout after setting new password but remove these - :sanctum',config('jetstream.auth_session'),'verified)
            // return redirect()->route('auth#loginPage);
            return back()->with(['match' => 'Successfully Changed Password!']);
        }
        return back()->with(['notMatch' => 'Incorrect current password!']);
    }


    // Direct Account Page
    public function accountPage(){
        return view('admin.profile.account');
    }

    // Edit Account Page
    public function editAccountPage(){
        return view('admin.profile.editAccountPage');
    }

    // Edit Account Info
    public function editAccount($id, Request $req){
        // Validation
        $this->accountInfoValidation($req);
        $data = $this->getUserData($req);

        /*
            1. Get Db_image name
            2. Check null or image (If null -> delete)
            3. Store
        */

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
        return redirect()->route('admin#accountPage');
    }

    // Control Admins Page\
    public function listPage(){
        $admins = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')
        ->paginate(4);
        return view('admin.profile.admins',compact('admins'));
    }

    // Delete Admin Account
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['delete'=>'Deleted Successfully!']);
    }

    // Change Role Page
    public function changeRolePage($id){
        $account = User::where('id',$id)->first();
        return view('admin.profile.changeRole',compact('account'));
    }

    // Change Role
    public function changeRole($id, Request $request){
        $data = $this->requestData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#listPage');
    }




    // Private Functions =========================>

    // Change Role
    private function requestData($request){
        return [
            'role' => $request->role
        ];
    }

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
