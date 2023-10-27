<?php

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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


Route::get('/', [\App\Http\Controllers\EmailController::class,'list']);

//Route::get('/', function () {
//
//
//    return view('welcome');
//});


// generate sanctum token based on user id
Route::get('/token/{user}/{name}', function ($user, $name) {
    $user = \App\Models\User::find($user);
    $token = $user->createToken($name);

    return ['token' => $token->plainTextToken, $user->toArray()];
});


// generate sanctum token based on user id
Route::get('/test-email/{user}', function (User $user) {

    Mail::to('testreceiver@gmail.com')
        ->send(new WelcomeMail($user , 'ucha19871@gmail.com','testing','testing body'));
});