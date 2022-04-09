<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Board;
use App\Models\task;
use Hash;
use Auth;
use Illuminate\Support\Facades\Crypt;
class UserController extends Controller
{  
     
     public function allUser(){
        $user = User::all();

        return response(['user'=>$user]);
     }
    //  for user register
    public function register(Request $request){

     $request->validate([
      'full_name' => 'required',
      'email' => 'required|unique:register',
      'password' =>'required',
     ]);

     User::create([
     'full_name' =>$request->full_name,
      'email' => $request->email,
      'password' => Crypt::encryptString($request->password),
     ]);
     return response(['message' =>'sucessfully inserted']);
    }

    //end part of registeration

    public function login(Request $request)
    {
     $userData = User::where('email',$request->email)->first();
     if(!empty($userData)){
        if(Crypt::decryptString($userData->password) == $request->password){
       $token =$userData->createToken('my-app-token')->plainTextToken;
            return response(['msg' =>'sucess','token'=> $token]);
        }
        else{
           return response(['msg' =>'wrong']);
        }
        
    }

    }
    //end user
    //start board
    public function allboard(){
       $board  =  Board::all();
       return response(["board"=>$board]);
    }
    public function addboard(Request $request){
        $id = Auth::id();
       // dd($request);
        $request->validate([
          'board_name' =>'required',
          'board_name' =>'required'
           
        ]);
         Board::create([
              'user_id'  =>$id,
              'board_name' =>$request->board_name,
              'board_description' =>$request->board_description

         ]);
         return response(['msg'=>'success']);
    }
    public function updateboard(Request $request,$id){
// dd($request);
        $request->validate([
          'board_name' =>'required',
          'board_description' =>'required'
           
        ]);
         $data =[];
         $data['board_name'] =$request->board_name;
         $data['board_description'] =$request->board_description;
    
         Board::where('id',$id)->update($data);
         return response(['msg'=>'sucess']);
    }
    public function delete($id){
        // dd($id);

        Board::where('id',$id)->delete();

        return response(['massage'=>'sucess']);
    }
   // end board
  // add task
    public function alltask(){
        $task =task::all();
        return response(['task'=>$task]);
    }
    public function addtask(Request $request){
        $id = Auth::id();
         $request->validate([
          'task_name' =>'required',
          'task_description' =>'required',
          'board_id' =>'required'
           
        ]);

         $task = Board::where('id',$request->board_id)->first();
         // dd($task,$request);
         if(!empty($task)){
             task::create([
              'user_id' => $id, 
              'board_id'  =>$request->board_id,
              'task_name' =>$request->task_name,
              'task_description' =>$request->task_description

         ]);
             return response(["msg" =>"sucessfully"]);
         }else{
            return response(["msg" =>"please enter board"]);
         }
        
    }
    public function updatetask(Request $request,$id){
        // dd($request);
        $request->validate([
          'task_name' =>'required',
          'task_description' =>'required',
          
           
        ]);
        task::where('id',$id)->update([
              
              'task_name' =>$request->task_name,
              'task_description' =>$request->task_description

         ]);
        return response(['msg'=>'updated']);

    }
    public function deletetask($id){
       task::where('id',$id)->delete();
       return response(['msg'=>'deleted']);
    }
    // End Task
}
