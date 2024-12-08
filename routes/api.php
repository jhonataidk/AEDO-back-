<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\OrgaoController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\UsuarioOrgaoController;
use App\Http\Controllers\HospitalUsuarioController;





// Rotas públicas (sem middleware)
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/registrar', [UserController::class, 'store'])->name('registrar');

// Rotas autenticadas
Route::get('/usuario-orgao/usuario/{id}', [UsuarioOrgaoController::class, 'showByUser']);

Route::prefix('users')->middleware('check.profile:1')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

// Rotas para órgãos (Apenas para profile_id 1)
Route::prefix('orgaos')->middleware('check.profile:1')->group(function () {
    Route::get('/', [OrgaoController::class, 'index']);
    Route::get('/{id}', [OrgaoController::class, 'show']);
    Route::post('/', [OrgaoController::class, 'store']);
    Route::put('/{id}', [OrgaoController::class, 'update']);
    Route::delete('/{id}', [OrgaoController::class, 'destroy']);
});

// Rotas para hospitais (Apenas para profile_id 1)
Route::prefix('hospitais')->middleware('check.profile:1')->group(function () {
    Route::get('/', [HospitalController::class, 'index']);
    Route::post('/', [HospitalController::class, 'store']);
    Route::get('/{id}', [HospitalController::class, 'show']);
    Route::put('/{id}', [HospitalController::class, 'update']);
    Route::delete('/{id}', [HospitalController::class, 'destroy']);
});

// Rotas para endereços (Apenas para profile_id 1, 2 e 3)
Route::prefix('enderecos')->group(function () {
    Route::get('/', [EnderecoController::class, 'index']);
    Route::get('/{id}', [EnderecoController::class, 'show']);
    Route::post('/', [EnderecoController::class, 'store']);
    Route::put('/{id}', [EnderecoController::class, 'update']);
    Route::delete('/{id}', [EnderecoController::class, 'destroy']);
});


// Rotas completas para usuário e órgãos (Acesso para profile_id 1)
Route::prefix('usuario-orgao')->middleware('check.profile:1')->group(function () {
    Route::get('/', [UsuarioOrgaoController::class, 'index']);
    Route::post('/', [UsuarioOrgaoController::class, 'store']);
    Route::get('/{id}', [UsuarioOrgaoController::class, 'show']);
    Route::put('/{id}', [UsuarioOrgaoController::class, 'update']);
    Route::delete('/{id}', [UsuarioOrgaoController::class, 'destroy']);
});

// Rotas para relação hospitais e usuários (Acesso para profile_id 1 e 2)
Route::prefix('hospital-usuario')->middleware('check.profile:1')->group(function () {
    Route::get('/', [HospitalUsuarioController::class, 'index']);
    Route::post('/', [HospitalUsuarioController::class, 'store']);
    Route::get('/{id}', [HospitalUsuarioController::class, 'show']);
    Route::put('/{id}', [HospitalUsuarioController::class, 'update']);
    Route::delete('/{id}', [HospitalUsuarioController::class, 'destroy']);
});

