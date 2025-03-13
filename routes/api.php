<?php

use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\EmpresasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('empresas')->group(function(){
    Route::get('/',[EmpresasController::class,'index']);
    Route::get('{codigo}',[EmpresasController::class,'show']);
    Route::post('/',[EmpresasController::class,'store']);
    Route::put('{codigo}',[EmpresasController::class,'update']);
    Route::delete('{codigo}',[EmpresasController::class,'destroy']);
});

Route::prefix('cliente')->group(function () {
    Route::delete('/destroy/{empresa}/{codigo}',[ClientesController::class,'destroy']);
    Route::get('/',[ClientesController::class,'index']);
    Route::get('/show/{empresa}/{codigo}',[ClientesController::class,'show']);
    Route::post('/store',[ClientesController::class,'store']);
    Route::put('{codigo}',[ClientesController::class,'update']);
});