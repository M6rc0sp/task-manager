<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\SetorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

Route::get('/setores', [SetorController::class, 'index'])->name('setores.index');
Route::get('/setores/list', [SetorController::class, 'list'])->name('setores.list');
Route::get('/setores/create', [SetorController::class, 'create'])->name('setores.create');
Route::post('/setores/store', [SetorController::class, 'store'])->name('setores.store');
Route::delete('/setores/{id}/delete', [SetorController::class, 'destroy'])->name('setores.delete');

Route::get('/chamados', [ChamadosController::class, 'index'])->name('chamados.index');
Route::get('/chamados/andamento', [ChamadosController::class, 'going'])->name('chamados.going');
Route::get('/chamados/concluidos', [ChamadosController::class, 'log'])->name('chamados.log');
Route::get('/chamados/create', [ChamadosController::class, 'create'])->name('chamados.create');
Route::get('/chamados/edit', [ChamadosController::class, 'edit'])->name('chamados.edit');
Route::post('/chamados/store', [ChamadosController::class, 'store'])->name('chamados.store');
Route::put('/chamados/{id}/atenderChamado', [ChamadosController::class, 'atenderChamado'])->name('chamados.atenderChamado');
Route::put('/chamados/{id}/finalizarChamado', [ChamadosController::class, 'finalizarChamado'])->name('chamados.finalizarChamado');
//Route::delete('/chamados/delete', [ChamadosController::class, 'delete'])->name('chamados.delete');