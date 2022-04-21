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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/compte', [App\Http\Controllers\UserController::class, 'compte'])->name('compte');

Route::get('/modifCompte', [App\Http\Controllers\UserController::class, 'modifCompte'])->name('modifCompte');
Route::put('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');
Route::put('/modifiermotdepasse', [App\Http\Controllers\UserController::class, 'modifiermotdepasse'])->name('modifiermotdepasse');


//route::méthode http ('url'     ,          [contrôleur          ,            'méthode'  ] ) ->   nom route
//Route::resource('/user', App\Http\Controllers\UserController::class)->except('index', 'show');