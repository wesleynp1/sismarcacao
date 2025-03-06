<?php

use App\Http\Controllers\serviceController;
use Illuminate\Support\Facades\Route;

//CREATE
Route::view('novoServico',"createService");
Route::post('createService', [serviceController::class, "createService"]);

//READ
Route::get('servicos', [serviceController::class, "readServices"]);

//UPDATE
Route::get ('editarServico/{idService}', [serviceController::class, "updateServiceForm"]);
Route::post('editarServico/{idService}', [serviceController::class, "updateService"]);

//DELETE
Route::get('deletarServico/{idService}', [serviceController::class, "deleteService"]);