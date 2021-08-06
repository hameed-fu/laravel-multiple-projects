<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Lib\Message;

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
    // $custom = new Message(); // object of custom class
    // dd($custom->cutomFunction());
    // return sendMessage("Hello world"); // call global custom helper
    return view('welcome');
});

Route::get('/counts', function () {
    return User::get()->count();
});

Auth::routes(['register'  => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts/delete', 'PostController@delete')->middleware('can:isAdmin')->name('post.delete');

Route::get('/export', [App\Http\Controllers\ExportController::class, 'export']);

Route::get('delete',function(){
    if(Gate::allows('isAdmin')){
        return "You are allowed";
    }else{
        return "You are not allowed";
    }
});
Route::get('delete1',function(){
    if(!Gate::denies('isAdmin')){
        return "You are allowed";
    }else{
        return "You are not allowed";
    }
});

Route::get('/reset-pass', function () {
    return view('auth.passwords.email');
})->middleware('guest');

Route::get('items-lists', 'App\Http\Controllers\ItemSearchController@index')->name('items-lists');
Route::post('create-item', 'App\Http\Controllers\ItemSearchController@create')->name('create-item');

