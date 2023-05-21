<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calendar;
use App\Http\Controllers\userController as User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/admin/login',[User::class,'adminLogin']);

Route::group(['middleware'=>'auth'],function(){
    Route::get('/',[Calendar::class,'index']);
    Route::post('upload_event',[Calendar::class,'upload_event']);
    Route::post('update_event',[Calendar::class,'update_event']);
    Route::get('/delete/{id}',[Calendar::class,'destroy_event']);

    Route::group(['middleware'=>'checkUserType'],function(){
      Route::post('/addAdmin',[User::class,'addAdmin']);  //call axios
      Route::get('/getAdmin',[User::class,'getAdmin']);  //call axios
      Route::post('/editAdmin',[User::class,'editAdmin']); //call axios
      Route::post('/deleteAdmin1',[User::class,'deleteAdmin']); //call axios
      Route::get('/admin/logout',[User::class,'admin_logout'])->name('admin.logout');
    });
});


