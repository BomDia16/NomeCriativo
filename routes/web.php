<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IngressoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
})->name('welcome');

// user
Route::get('/login', [UserController::class, 'index_login'])->name('view.login');
Route::get('/register', [UserController::class, 'index_register'])->name('user.register');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');
Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');

// admin
Route::get('/admin/login', [AdminController::class, 'index_login'])->name('view.login-admin');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/list', [AdminController::class, 'list'])->name('admin.list');

// ingresso
Route::get('/admin/ingresso/list', [IngressoController::class, 'list'])->name('ingresso.list');

// pedidos
Route::get('/admin/pedido/list', [PedidoController::class, 'list'])->name('pedido.list');

Route::resources(['/user' => UserController::class]);
Route::resources(['/ingresso' => IngressoController::class]);
Route::resources(['/pedido' => PedidoController::class]);
Route::resources(['/admin' => AdminController::class]);
