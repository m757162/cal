<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Calendar as Model_calendar;
use App\Models\User;
use Validator;

class Calendar extends Controller
{
   function index(Request $req){     
      $data['calendar']=Model_calendar::all();
      $data['user']=User::all();
      return view('Calendar',$data);
   }
   // function chart(Request $req){
   //    $calendar=Model_calendar::all();
   //    return view('chart',['data'=>$calendar]);
   // }

   function upload_event(Request $req){

      $validated = Validator::make($req->all(), [
           'title' => 'required|unique:calendars,title', 
           'color' => 'required',
      ]);
      if ($validated->fails()) {
         return response()->json($validated->errors()->all(),201);
      } 
      $calendardata= Model_calendar::create([
         'title'=> $req->input('title'),
         'color'=> $req->input('color'),
         'description'=> $req->input('description'),
         'link'=> $req->input('link'),
         "start"=> $req->input('start_date'),
         "end"=> $req->input('end_date'),
      ]);
      return response()->json(["data"=>$calendardata],200);
   }

   function update_event(Request $req){
      
      $validated = Validator::make($req->all(),[
         'title' => 'required', 
         'color' => 'required', 
         'start_date' => 'required', 
         'end_date' => 'required', 
      ]);
      if ($validated->fails()) {
         return response()->json($validated->errors()->all(),201);
      }
      if($validated){
         $calendardata= Model_calendar::find($req->input('id'))->update([
            'title'=> $req->input('title'),
            'description'=> $req->input('description'),
            'link'=> $req->input('link'),
            'color'=> $req->input('color'),
            "start"=> $req->input('start_date'),
            "end"=> $req->input('end_date'),
         ]);
         $update_calendar=Model_calendar::find($req->input('id'));
         return response()->json($update_calendar,200);
      }else{
           return 0;
      } 
   }
   function destroy_event(Request $req,$id){
      return Model_calendar::find($id)->delete();
   }
}
