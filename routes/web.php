<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\RegisterController;

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
    return view('homepage');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/minhaconta/{uuid}',function($uuid){
    $user = User::where('uuid',$uuid)->first();
    return View::make('myaccount',compact('user'));
})->name('minhaconta')->middleware(['auth' => 'verified']);

Auth::routes(['verify'=> true]);

Route::get('/feed', [App\Http\Controllers\HomeController::class, 'index'])->name('feed');
