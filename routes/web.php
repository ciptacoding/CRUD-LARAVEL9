<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
  Disini kita akan menggunakan route dengan type resource yang artinya route tersebut akan berisi beberapa route - route untuk kebutuhan CRUD, seperti index, create, store, show, edit, update, dan destroy. 
*/
Route::resource('/posts', \App\Http\Controllers\PostController::class);