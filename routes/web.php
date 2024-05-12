<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ControlUserController;
use App\Http\Controllers\User\ContactController;


// Login & Logout
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {

    // Direct Dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // Admin
    Route::middleware(['admin_auth'])->group(function(){

        // => Catagory Page
        Route::prefix('catagory')->group(function(){
            // List Page
            Route::get('list',[CatagoryController::class,'list'])->name('catagory#list');
            // Create Page
            Route::get('catagory/page',[CatagoryController::class,'createPage'])->name('catagory#createPage');
            // Create
            Route::post('create',[CatagoryController::class,'create'])->name('catagory#create');
            // Delete
            Route::get('delete/{id}',[CatagoryController::class,'delete'])->name('catagory#delete');
            // Update Page
            Route::get('update/page/{id}',[CatagoryController::class,'updatePage'])->name('catagory#updatePage');
            // Update
            Route::post('update',[CatagoryController::class,'update'])->name('catagory#update');
        });

        // => Admin Profile
        Route::prefix('admin')->group(function(){
            // Password =====>
            // Password Change Page
            Route::get('passwordChange/page',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            // Change Password
            Route::post('passwordChange/page',[AdminController::class,'changePassword'])->name('admin#changePassword');

            // Account =====>
            // Account Page
            Route::get('account/page',[AdminController::class,'accountPage'])->name('admin#accountPage');
            // Edit Account Page
            Route::get('editAccount/page',[AdminController::class,'editAccountPage'])->name('admin#editAccountPage');
            // Edit Account Info
            Route::post('editAccount/{id}',[AdminController::class,'editAccount'])->name('admin#editAccount');

            // Control Admins =====>
            // Control Admins List Page
            Route::get('list',[AdminController::class,'listPage'])->name('admin#listPage');
            // Delete Admin Account
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            // Change Role Page
            Route::get('changeRolePage/{id}',[AdminController::class,'changeRolePage'])->name('admin#changeRolePage');
            // Change Role
            Route::post('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
        });

        // => Products Page
        Route::prefix('product')->group(function(){
            // List Page
            Route::get('listPage',[ProductController::class,'listPage'])->name('product#listPage');
            // Create Page
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            // Create
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            // View
            Route::get('view/{id}',[ProductController::class,'view'])->name('product#view');
            // Update Page
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            // Update
            Route::post('update',[ProductController::class,'update'])->name('product#update');
            // delete
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        });

        // Order Page
        Route::prefix('order')->group(function(){
            // List Page
            Route::get('listPage',[OrderController::class,'listPage'])->name('order#listPage');
            // Order Sorting Ajax
            Route::get('ajax/sortOrder',[OrderController::class,'sortOrder'])->name('ajax#ortOrder');
            // Change Order Status
            Route::get('ajax/changeOrder',[OrderController::class,'changeOrder'])->name('ajax#changeOrder');
            // Order Detail
            Route::get('ajax/detailOrder/{orderCode}',[OrderController::class,'detailOrder'])->name('ajax#detailOrder');
        });

        // Control Users
        Route::prefix('user')->group(function(){
            // List Page
            Route::get('control',[ControlUserController::class,'control'])->name('user#control');
            // Change Role
            Route::get('changeRole',[ControlUserController::class,'changeRole'])->name('user#changeRole');
            // Delete User Account
            Route::get('delete',[ControlUserController::class,'delete'])->name('user#delete');
            // Edit Page
            Route::get('editPage/{id}',[ControlUserController::class,'editPage'])->name('user#editPage');
            // Edit
            Route::post('edit/UserAccount/{id}',[ControlUserController::class,'edit'])->name('user#editUserAccount');
        });

        // User Contact Page
        Route::get('servicePage',[ServiceController::class,'servicePage'])->name('user#servicePage');
        // Delete
        Route::get('deleteContact',[ServiceController::class,'deleteContact'])->name('user#deleteContact');
        // View
        Route::get('viewReport/{id}',[ServiceController::class,'viewReport'])->name('user#viewReport');
        // Reply
        Route::post('reply/{id}',[ServiceController::class,'reply'])->name('user#reply');

    });

    // User
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function(){

        // Home Page
        Route::get('/homePage',[UserController::class,'homepage'])->name('user#homePage');

        // Filter Pizza
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');
        // Ajax
        Route::prefix('ajax')->group(function(){
            // Sorting
            Route::get('pizzaSorting',[AjaxController::class,'pizzaSorting'])->name('user#pizzaSorting');
            // Add to cart
            Route::get('addCart',[AjaxController::class,'addCart'])->name('user#addCart');
            // Add cart datas to Orderlist
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            // Clear All Cart Items
            Route::get('clearCart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            // Clear selected Cart Item
            Route::get('clearCartItem',[AjaxController::class,'clearCartItem'])->name('ajax#clearCartItem');
            // View Count
            Route::get('viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
        });
        // Pizza Detail
        Route::get('pizzaDetail/{id}',[UserController::class,'pizzaDetail'])->name('user#pizzaDetail');

        // Cart
        Route::prefix('cart')->group(function(){
            // Cart Page
            Route::get('listPage',[UserController::class,'cartListPage'])->name('user#cartListPage');
        });

        // Ordered History Page
        Route::get('ordersPage',[UserController::class,'ordersPage'])->name('user#ordersPage');

        // User Profile
        // Password Page
        Route::get('passwordPage',[UserController::class,'passwordPage'])->name('user#passwordPage');
        // Change Password
        Route::post('password',[UserController::class,'password'])->name('user#password');
        // Account Page
        Route::get('accountPage',[UserController::class,'accountPage'])->name('user#accountPage');
        // Edit Account
        Route::post('edit/{id}',[UserController::class,'editAccount'])->name('user#edit');

        // Contact Page
        Route::get('contactPage',[ContactController::class,'contactPage'])->name('user#contactPage');
        // Send Message
        Route::post('contact',[ContactController::class,'contact'])->name('user#contact');
        // Delete Reply
        Route::get('delReply',[ContactController::class,'delReply'])->name('user#delReply');
    });

});





