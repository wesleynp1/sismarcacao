<?php

use App\Http\Controllers\serviceController;
use Illuminate\Support\Facades\Route;

//CREATE
Route::view('novoServico',"createService")->middleware("auth");
Route::post('createService', [serviceController::class, "createService"])->middleware("auth");

//READ
Route::get('servicos', [serviceController::class, "readServices"]);

//UPDATE
Route::get ('editarServico/{idService}', [serviceController::class, "updateServiceForm"])->middleware("auth");
Route::post('editarServico/{idService}', [serviceController::class, "updateService"])->middleware("auth");

//DELETE
Route::get('deletarServico/{idService}', [serviceController::class, "deleteService"])->middleware("auth");