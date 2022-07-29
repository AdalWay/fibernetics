<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Modeles\User;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users', [UserController::class, 'index'] )->name('users.index');
Route::post('users', [UserController::class, 'store'] )->name('users.store');
Route::get('users/{user}', [UserController::class, 'show'] )->name('users.show');
Route::delete('users/{user}', [UserController::class, 'destroy'] )->name('users.destroy');


//NOTE: The update method is supposed to be PUT, but the route is not working.
//is a well know issues in laravel, so they recoment to use POST instead. Here is how suppose to be done:
////Route::put('users/{user}', [UserController::class, 'update'] )->name('users.update');
/// This is the fix: cheat the laravel and use POST instead of PUT.
Route::post('users/{user}', [UserController::class, 'update'] )->name('users.update');



