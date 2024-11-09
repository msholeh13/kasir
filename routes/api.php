<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\SupplierApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::get('/test', function () {
//     return response()->json(['message' => 'API is working!']);
// });


Route::get('/barang', [BarangApiController::class, 'index']);
Route::post('/barang', [BarangApiController::class, 'store']);
Route::get('/barang/{nobarcode}', [BarangApiController::class, 'show']);
Route::delete('/barang/{nobarcode}', [BarangApiController::class, 'destroy']);
Route::put('/barang/{nobarcode}', [BarangApiController::class, 'update']);

Route::get('/supplier', [SupplierApiController::class, 'index']);
Route::post('/supplier', [SupplierApiController::class, 'store']);
Route::get('/supplier/{idsup}', [SupplierApiController::class, 'show']);
Route::delete('/supplier/{idsup}', [SupplierApiController::class, 'destroy']);
Route::put('/supplier/{idsup}', [SupplierApiController::class, 'update']);
