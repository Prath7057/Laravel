<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('signin');
});
Route::get('/signin', function () {
    return view('signin');
})->name('signin');
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/HomePage', function () {
    $user = session('loggedInUser');
    if (!$user) {
        return redirect()->route('signin')->withErrors(['session_expired' => 'Your session has expired. Please log in again.']);
    }
    return view('welcome', ['user' => $user]);
})->name('HomePage');
Route::post('/signupdata',[LoginController::class,'signupdata'])->name('signupdata');
Route::post('/signindata',[LoginController::class,'signindata'])->name('signindata');
Route::get('/updateUser/{user_id}',[LoginController::class,'updateUser'])->name('updateUser');
Route::get('/deleteUser/{user_id}',[LoginController::class,'deleteUser'])->name('deleteUser');