<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\TipoPessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoPessoaController extends Controller
{
    
    public readonly TipoPessoa $tipo_pessoa;

    public function __construct(){

        $this->tipo_pessoa = new TipoPessoa();
    }


    public function index()
    {
       
        $tipo_pessoa = TipoPessoa::all();

        return response()->json(['data'=>$tipo_pessoa]);
    }

   
    public function store(Request $request)
    {
                $tipo_pessoa = DB::table('tipo_pessoa')->insert([
                'tipo' => $request->input('tipo')
            ]);

            try{
                        if($tipo_pessoa){
                        return response()->json(['message'=>'Tipo de acesso criado com sucesso', $tipo_pessoa]);
                    }else{
                        return response()->json(['message'=>'Tipo de acesso não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }
    }

   
    public function show(string $nome)
    {
        $tipo_pessoa = DB::table('tipo_pessoa')->where('tipo','like','%'.$nome.'%')->get();
        return response()->json(['portaria'=>$tipo_pessoa]);
    }

   
    public function edit(string $id)
    {
        $tipo_pessoa = $this->tipo_pessoa->where('id',$id)->get();

        return response()->json(['data'=>$tipo_pessoa]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualizaTipo =  $request->only(['tipo']);
    
    $alteracao = DB::table('tipo_pessoa')
    ->where('id', $id)->update($atualizaTipo);

    if($alteracao === 0){
        return response()->json(['message'=>'Tipo de acesso não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Tipo de acesso alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $tipo_pessoa = DB::table('tipo_pessoa')->where('id', $id)->first();

       if(!$tipo_pessoa){
        return response()->json(['message'=>'Tipo de acesso não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('tipo_pessoa')->where('id', $id)->delete();
           return response()->json(['message'=>'Tipo de acesso excluida com sucesso!']);
        }
    }
}
// verificar acredito que não podera ser destruido o campo
//pois existe relacionamento
