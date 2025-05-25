<?php

use App\Http\Controllers\schedulingController;
use Illuminate\Support\Facades\Route;

//CREATE
Route::get('novaMarcacao/{serviceIntentedId?}', [schedulingController::class, "formCreateScheduling"]);
Route::post('novaMarcacao',             [schedulingController::class, "createScheduling"]);

//READ
Route::get('agendamentos', [schedulingController::class, "readScheduling"]);

//UPDATE
Route::get ('editarAgendamento/{id}', [schedulingController::class, "formUpdateScheduling"]);
Route::post('editarAgendamento/{id}', [schedulingController::class, "updateScheduling"]);

//DELETE
Route::get ('deletarAgendamento/{id}', [schedulingController::class, "formDeleteScheduling"]);
Route::post('deletarAgendamento/{id}', [schedulingController::class, "deleteScheduling"]);