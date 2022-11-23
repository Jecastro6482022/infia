<?php

use App\Exports\UsersExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\articulos;
use App\Http\Controllers\usuarios;
use App\Http\Controllers\empresas;
use App\Http\Controllers\facturas;
use App\Http\Controllers\entradas;
use App\Http\Controllers\roles;
use App\Http\Controllers\salidas;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\inventario;

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

/*Pagina comercial*/

Route::view('/', 'home')->name('home');
Route::view('/Login', 'login')->name('login');
Route::view('/Main', 'main')->name('main');

// Route::view('/', 'main')->name('main');
//vistas Facturas
Route::view('/Facturas/registro', 'Facturas.registrar_factura')->name('reg_factura');
Route::post('/Facturas/registro', facturas::class . '@store')->name('post_reg_factura');
Route::get('/Facturas/ver', facturas::class . '@index')->name('ver_factura');
Route::get('/Facturas/registro', facturas::class . '@index_reg')->name('reg_factura');
Route::get('/Facturas/editar/{factura}', facturas::class . '@edit')->name('edit_factura');
Route::patch('Facturas/editar/{factura}', facturas::class . '@update')->name('update_factura');

Route::get('facturas.pdf', [facturas::class, 'exportPdf'])->name('pdf_factura');
Route::get('facturas.print', [facturas::class, 'printPdf'])->name('print_factura');
Route::get('factura.csv', function (UsersExport $usersExport) {
    return $usersExport->download('facturas.csv');
})->name('csv_factura');
Route::get('factura.xlsx', function (UsersExport $usersExport) {
    return $usersExport->download('factura.xlsx');
})->name('excel_factura');

Route::get('/Facturas/ver/{factura}', facturas::class . '@printFactura')->name('print_factura');

//vistas Empresas
 
Route::get('/Empresas', function () {
    return view('empresas');
});
Route::resource('Empresas', empresas::class);
Route::get('empresas.pdf', [empresas::class, 'exportPdf'])->name('pdf_empresa');
Route::get('empresas.print', [empresas::class, 'printPdf'])->name('print_empresa');
Route::get('empresa.csv', function (UsersExport $usersExport) {
    return $usersExport->download('empresas.csv');
})->name('csv_empresa');
Route::get('empresa.xlsx', function (UsersExport $usersExport) {
    return $usersExport->download('empresa.xlsx');
})->name('excel_empresa');


//vistas Articulos
Route::view('/Articulos/registro', 'Articulos.registrar_articulo')->name('reg_articulo');
Route::post('/Articulos/registro', articulos::class . '@store')->name('post_reg_articulos');
Route::get('/Articulos/ver', articulos::class . '@index')->name('ver_articulo');
Route::get('/Articulos/{articulo}/editar', articulos::class . '@edit')->name('edit_articulo');
Route::patch('/Articulos/{articulo}', articulos::class . '@update')->name('update_articulo');
Route::delete('/Articulos/{articulo}', articulos::class . '@destroy')->name('delete_articulo');

Route::get('articulos.pdf', [articulos::class, 'exportPdf'])->name('pdf_articulo');
Route::get('articulos.print', [articulos::class, 'printPdf'])->name('print_articulo');
Route::get('articulos.csv', function (UsersExport $usersExport) {
    return $usersExport->download('articulo.csv');
})->name('csv_articulo');
Route::get('articulos.xlsx', function (UsersExport $usersExport) {
    return $usersExport->download('articulo.xlsx');
})->name('excel_articulo');

//vistas Usuarios
Route::view('/Usuarios/registro', 'usuarios.registrar_usuario')->name('reg_usuario');
Route::post('/Usuarios/registro', [usuarios::class, 'store'])->name('post_reg_usuario');
Route::get('/Usuarios/ver', [usuarios::class, 'index'])->name('ver_usuario');
Route::get('/Usuarios/registro', [usuarios::class, 'index2'])->name('reg_usuario');
Route::get('/Usuarios/editar/{usuario}', [usuarios::class, 'edit'])->name('edit_usuario');
Route::patch('/Usuarios/editar/{usuario}', [usuarios::class, 'update'])->name('update_usuario');
Route::delete('/Usuarios/ver/{usuario}', [usuarios::class, 'destroy'])->name('delete_usuario');

Route::get('usuarios.pdf', [usuarios::class, 'exportPdf'])->name('pdf_user');
Route::get('usuarios.print', [usuarios::class, 'printPdf'])->name('print_user');
Route::get('usuarios.csv', function (UsersExport $usersExport) {
    return $usersExport->download('users.csv');
})->name('csv_user');
Route::get('usuarios.xlsx', function (UsersExport $usersExport) {
    return $usersExport->download('users.xlsx');
})->name('excel_user');



//vista roles
Route::view('/Usuario/Registro/Roles', 'usuarios.roles')->name('crear_rol');
Route::post('/Usuario/Registro/Roles', [roles::class, 'store'])->name('post_crear_rol');
Route::get('/Usuario/Registro/Roles', [roles::class, 'index'])->name('crear_rol');
Route::get('/Usuario/Registro/editar/{rol}', [roles::class, 'edit'])->name('edit_rol');
Route::patch('/Usuario/Registro/editar/{rol}', [roles::class, 'update'])->name('update_rol');
Route::delete('/Usuario/Registro/{rol}', roles::class . '@destroy')->name('delete_rol');

//vistas Salidas
Route::view('/Salidas/registro', 'salidas.registrar_salida')->name('reg_salida');
Route::post('/Salidas/registro', [salidas::class, 'store'])->name('post_reg_salida');
Route::get('/Salidas/registro', [salidas::class, 'index2'])->name('reg_salida');
Route::get('/Salidas/ver', [salidas::class, 'index'])->name('ver_salida');

Route::get('salidas.pdf', [salidas::class, 'exportPdf'])->name('pdf_salida');
Route::get('salidas.print', [salidas::class, 'printPdf'])->name('print_salida');
Route::get('salidas.csv', function (UsersExport $usersExport) {
    return $usersExport->download('salidas.csv');
})->name('csv_salida');
Route::get('salidas.xlsx', function (UsersExport $usersExport) {
    return $usersExport->download('salidas.xlsx');
})->name('excel_salida');

//vistas Entradas
Route::view('/Entradas/registro', 'entradas.registrar_entrada')->name('reg_entrada');
Route::post('/Entradas/registro', [entradas::class, 'store'])->name('post_reg_entrada');
Route::get('/Entradas/registro', [entradas::class, 'index2'])->name('reg_entrada');
Route::get('/Entradas/Ver', [entradas::class, 'index'])->name('ver_entrada');

Route::get('entradas.pdf', [entradas::class, 'exportPdf'])->name('pdf_entrada');
Route::get('entradas.print', [entradas::class, 'printPdf'])->name('print_entrada');
Route::get('entradas.csv', function (UsersExport $usersExport) {
    return $usersExport->download('entradas.csv');
})->name('csv_entrada');
Route::get('entradas.xlsx', function (UsersExport $usersExport) {
    return $usersExport->download('entradas.xlsx');
})->name('excel_entrada');


//vistas Inventarios
Route::view('/Inventarios/Ver', 'inventarios.inventarios')->name('ver_inventario');

Route::post('/Login', [usuarios::class, 'login'])->name('login');
Route::get('/Inventarios/Ver', [inventario::class, 'index'])->name('ver_inventario');

//vistas Reportes
Route::view('/Reportes/Ver', 'reportes.reportes')->name('ver_reportes');