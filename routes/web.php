<?php

use App\Http\Controllers\MenuController;
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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    // broadcast(new App\Events\WebsocketDemoEvent('ini text yang di pass'));
    return view('welcome');
});
Route::get('/get_chat', 'MessageController@GetChat');
Route::get('/chat_room', 'MessageController@ChatRoom');
Route::post('/send_chat', 'MessageController@SendChat');
Route::resource('menu', 'MenuController');

Route::group(['prefix' => 'data'], function() {
    Route::get('/menu', 'MenuController@get_data');
});
