<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ClienteServicoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('cliente',ClientesController::class);

Route::apiResource('/servico', ServicoController::class);

Route::apiResource('/profissional', ProfissionalController::class);

Route::apiResource('/agendamento', AgendamentoController::class);

Route::apiResource('/cliente_servico', ClienteServicoController::class);
