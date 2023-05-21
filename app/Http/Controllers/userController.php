<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class userController extends Controller
{
    //  show admin login page 
   function adminLoginPage(){
      return view('login');
   }
     // admin login process
   function adminLogin(Request $req){   
      return $user=Auth::attempt(["email"=>$req->input('email'),"password"=>$req->input('password')]);  
   }
  
     // admin logout
   function admin_logout(){
      Auth::logout();
      return redirect(route('admin.login'));
   }
  
   // show admin add page
   function addAdmin_page(){
      return view('addAdmin');
   }
   // get all admin list
   function getAdmin(){
      return User::all();
   }
   // insert new admin
   function addAdmin(Request $req){
      $validated = Validator::make($req->all(), [
         'email' => 'required|email|unique:users,email',
         'password'=> 'required|min:5',       
      ]);
      if ($validated->fails()) {
         return response()->json($validated->errors()->all(),201);
      }

      User::insert([
         "email"=>$req->email,
         "password"=>Hash::make($req->password),
         "user_type"=>$req->user_type
      ]);
      return $user=Auth::attempt(["email"=>$req->email,"password"=>$req->password]);  
   }
   //   edit admin
   function editAdmin(Request $req){

      $validated = Validator::make($req->all(), [
         'adminEmail' => 'required|email',
         // 'adminPsw'=> 'required|min:5',     
      ]);
      if ($validated->fails()) {
         return response()->json($validated->errors()->all(),201);
      }
      $id=$req->input('adminId');
      $email=$req->input('adminEmail');
      $psw=$req->input('adminPsw');
      $usertype=$req->input('edit_usertype');
      if(empty($psw)){
         return $cata_editv=User::find($id)->update([
            'email'=>$email,
            
            'user_type'=>$usertype,
         ]);
      }
      return $cata_editv=User::find($id)->update([
         'email'=>$email,
         'password'=>Hash::make($psw),
         'user_type'=>$usertype,
      ]);
   }
   function deleteAdmin(Request $req){
      $id=$req->input('deleteid');      
      $delete=User::find($id)->delete(); 
      if($delete == true){
        return 1;
      }
   }
 // end add admin by old admin ///
}
