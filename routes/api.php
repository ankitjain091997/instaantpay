<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::get('/allUser',[UserController::class,'allUser']);


Route::middleware('auth:sanctum')->group(function(){
    //for board
    Route::get('/allboard',[UserController::class,'allboard']);
    Route::post('/board',[UserController::class,'board']);
    Route::put('/updateboard/{id}',[UserController::class,'updateboard']);
    Route::delete('/delete/{id}',[UserController::class,'delete']);
    //end board
    //task
    Route::get('/alltask',[UserController::class,'alltask']);
    Route::post('/addtask',[UserController::class,'addtask']);
    Route::put('/updatetask/{id}',[UserController::class,'updatetask']);
    Route::delete('/deletetask/{id}',[UserController::class,'deletetask']);
   //end task
});
