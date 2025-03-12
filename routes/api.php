<?php

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