<?php

use App\Http\Controllers\api\PessoaController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

Route::get('/pessoa', [PessoaController::class, 'index']);                      //ok
Route::delete('/pessoa/{id}', [PessoaController::class, 'destroy']);            //ok
Route::post('/pessoa',[PessoaController::class, 'store']);                      //-falta
Route::get('/pessoa/proc/{nome}', [PessoaController::class, 'show']);           //ok
Route::put('/pessoa/{id}',[PessoaController::class, 'update']);

Route::get('/', function () {
    return (['message'=>'welcome connected success']);
});
*/
