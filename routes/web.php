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

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/compte', [App\Http\Controllers\UserController::class, 'compte'])->name('compte');

Route::get('/modifCompte', [App\Http\Controllers\UserController::class, 'modifCompte'])->name('modifCompte');
Route::put('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');
Route::put('/modifiermotdepasse', [App\Http\Controllers\UserController::class, 'modifiermotdepasse'])->name('modifiermotdepasse');
Route::delete('supprimercompte', [App\Http\Controllers\UserController::class, 'destroy'])->name('supprimercompte');

//Création des routes pour les messages
Route::resource('/message', App\Http\Controllers\MessageController::class)->except('create');

//Routes pour les commentaires
Route::resource('/commentaire', App\Http\Controllers\CommentaireController::class);

//Routes pour faire la recherche
Route::get('/search', [App\Http\Controllers\MessageController::class, 'search'])->name('search');
//route::méthode http ('url'     ,          [contrôleur          ,            'méthode'  ] ) ->   nom route
//Route::resource('/user', App\Http\Controllers\UserController::class)->except('index', 'show');