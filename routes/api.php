<?php

use App\Http\Controllers\Api\EmpresasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/empresas/teste',[EmpresasController::class,'teste']);
