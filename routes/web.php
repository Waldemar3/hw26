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
Route::post('/users', function () {
    $data = request()->toArray();

    $user = new \App\User();
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->email_verified_at = now();
    $user->remember_token = \Illuminate\Support\Str::random(10);
    $user->password = $data['password'];

    $user->save();

    return response(['id' => $user->id], 200);
});

Route::get('/users/{user}', function (\App\User $user) {
    return view('users', ['user' => $user]);
});

Route::put('/users/{user}', function (\App\User $user) {
    $data = request()->toArray();

    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = $data['password'];

    $user->save();

    return response([], 200);
});

Route::delete('/users/{user}', function (\App\User $user) {
    $user->delete();

    return response([], 200);
});
