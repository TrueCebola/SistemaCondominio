<?php

use App\Http\Controllers\api\AutorizaAgendaController;
use App\Http\Controllers\api\CondominioController;
use App\Http\Controllers\api\CorreioController;
use App\Http\Controllers\api\LoteController;
use App\Http\Controllers\api\MovimentacaoController;
use App\Http\Controllers\api\PessoaController;
use App\Http\Controllers\api\PortariaController;
use App\Http\Controllers\api\TipoPessoaController;
use App\Http\Controllers\api\VeiculoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//repositorio e instalar
//https://www.linkedin.com/pulse/clonando-e-configurando-um-reposit%C3%B3rio-laravel-jo%C3%A3o-manoel/?originalSubdomain=pt

//chamada da rota http://localhost:800/api/ ->

//rodar o php artisan route:list


/**
 * GET|HEAD  api/pessoa ................................................................................................................................ api\PessoaController@index  
 * POST      api/pessoa ................................................................................................................................ api\PessoaController@store  
 * GET|HEAD  api/pessoa/proc/{nome} ..................................................................................................................... api\PessoaController@show  
 * DELETE    api/pessoa/{id} ......................................................................................................................... api\PessoaController@destroy  
 * PUT       api/pessoa/{id} .......................................................................................................................... api\PessoaController@update 
 */

Route::get('/pessoa', [PessoaController::class, 'index']);                      //ok
Route::delete('/pessoa/{id}', [PessoaController::class, 'destroy']);            //ok
Route::post('/pessoa',[PessoaController::class, 'store']);                      //ok
Route::get('/pessoa/proc/{nome}', [PessoaController::class, 'show']);           //ok
Route::put('/pessoa/{id}',[PessoaController::class, 'update']);                 //ok
//Route::get('/pessoa/edit/{id}',[PessoaController::class, 'edit']);            //-falta

//Portaria rotas
//chamada da rota http://localhost:800/api/ ->
Route::get('/portaria', [PortariaController::class, 'index']);
Route::delete('/portaria/{id}', [PortariaController::class, 'destroy']);
Route::post('/portaria', [PortariaController::class, 'store']);
Route::get('/portaria/proc/{nome}', [PortariaController::class, 'show']);
Route::put('/portaria/{id}', [PortariaController::class, 'update']);

//tipo_pessoa
Route::get('/tipo', [TipoPessoaController::class, 'index']);
Route::delete('/tipo/{id}', [TipoPessoaController::class, 'destroy']);
Route::post('/tipo', [TipoPessoaController::class, 'store']);
Route::get('/tipo/proc/{nome}', [TipoPessoaController::class, 'show']);
Route::put('/tipo/{id}', [TipoPessoaController::class, 'update']);

//veiculo
Route::get('/veiculo', [VeiculoController::class, 'index']);
Route::delete('/veiculo/{id}', [VeiculoController::class, 'destroy']);
Route::post('/veiculo', [VeiculoController::class, 'store']);
Route::get('/veiculo/proc/{nome}', [VeiculoController::class, 'show']);
Route::put('/veiculo/{id}', [VeiculoController::class, 'update']);

//movimentação
Route::get('/movimentacao', [MovimentacaoController::class, 'index']);
Route::delete('/movimentacao/{id}', [MovimentacaoController::class, 'destroy']);
Route::post('/movimentacao', [MovimentacaoController::class, 'store']);
Route::get('/movimentacao/proc/{nome}', [MovimentacaoController::class, 'show']);
Route::put('/movimentacao/{id}', [MovimentacaoController::class, 'update']);

//lote
Route::get('/lote', [LoteController::class, 'index']);
Route::delete('/lote/{id}', [LoteController::class, 'destroy']);
Route::post('/lote', [LoteController::class, 'store']);
Route::get('/lote/proc/{nome}', [LoteController::class, 'show']);
Route::put('/lote/{id}', [LoteController::class, 'update']);

//correio
Route::get('/correio', [CorreioController::class, 'index']);
Route::delete('/correio/{id}', [CorreioController::class, 'destroy']);
Route::post('/correio', [CorreioController::class, 'store']);
Route::get('/correio/proc/{nome}', [CorreioController::class, 'show']);
Route::put('/correio/{id}', [CorreioController::class, 'update']);

//condominio
Route::get('/condominio', [CondominioController::class, 'index']);
Route::delete('/condominio/{id}', [CondominioController::class, 'destroy']);
Route::post('/condominio', [CondominioController::class, 'store']);
Route::get('/condominio/proc/{id}', [CondominioController::class, 'show']);
Route::put('/condominio/{id}', [CondominioController::class, 'update']);

//autorização agenda
Route::get('/autoriza_agenda', [AutorizaAgendaController::class, 'index']);
Route::delete('/autoriza_agenda/{id}', [AutorizaAgendaController::class, 'destroy']);
Route::post('/autoriza_agenda', [AutorizaAgendaController::class, 'store']);
Route::get('/autoriza_agenda/proc/{nome}', [AutorizaAgendaController::class, 'show']);
Route::put('/autoriza_agenda/{id}', [AutorizaAgendaController::class, 'update']);




















/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/