<?php

use App\Exports\UsersExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\PeliculasController;


/*Pagina comercial*/
Route::view('/', 'home')->name('home');
Route::get('/autores', function () {
    return view('autores');
});
Route::resource('autores', AutoresController::class);

Route::get('/categorias', function () {
    return view('categorias');
});
Route::resource('categorias', CategoriasController::class);

Route::get('/peliculas', function () {
    return view('peliculas');
});
Route::resource('peliculas', PeliculasController::class);