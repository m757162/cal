<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calendar;
use App\Http\Controllers\userController as User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/admin/login',[User::class,'adminLogin']);
Route::get('/admin/login',[User::class,'adminLoginPage'])->name('admin.login');


Route::group(['middleware'=>'auth'],function(){
    Route::get('/',[Calendar::class,'index']);
    Route::post('upload_event',[Calendar::class,'upload_event']);
    Route::post('update_event',[Calendar::class,'update_event']);
    Route::get('/delete/{id}',[Calendar::class,'destroy_event']);

    Route::group(['middleware'=>'checkUserType'],function(){
      Route::get('/addUser',[User::class,'addAdmin_page'])->name('addAdmin.page');
      Route::post('/addAdmin',[User::class,'addAdmin']);  //call axios
      Route::get('/getAdmin',[User::class,'getAdmin']);  //call axios
      Route::post('/editAdmin',[User::class,'editAdmin']); //call axios
      Route::post('/deleteAdmin1',[User::class,'deleteAdmin']); //call axios
      Route::get('/admin/logout',[User::class,'admin_logout'])->name('admin.logout');
    });
});