<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Direct Login Page
    public function loginPage(){
        return view('login');
    }

    // Direct Register Page
    public function registerPage(){
        return view('register');
    }

    // Direct Dashboard Page that will navigate to Admin or User
    public function dashboard(){
        if (Auth::user()->role=='admin') {
            return redirect()->route('catagory#list');
        }
        return redirect()->route('user#homePage');
    }

}
