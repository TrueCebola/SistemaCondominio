<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Correio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorreioController extends Controller
{
    public readonly Correio $correio;

    public function __construct(){

        $this->correio = new Correio();
    }


    public function index()
    {
        $allCon = Correio::all();

        return response()->json(['data'=>$allCon]);
    }

       
    public function store(Request $request)
    {
                $correio = DB::table('correio')->insert([
                'id_portaria' => $request->input('id_portaria'),
                'id_pessoa' => $request->input('id_pessoa'),
                'tipo_encomenda' => $request->input('tipo_encomenda'),
                'observacoes' => $request->input('observacoes'),
                'active' => $request->input('active')
                  ]);

            try{
                        if($correio){
                        return response()->json(['message'=>'Alerta de encomenda criado com sucesso', $correio]);
                    }else{
                        return response()->json(['message'=>'Alerta não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }
    }

   
    public function show(string $nome)
    {
        $correio = DB::table('correio')->where('id_pessoa', $nome)->get();
        
        if($correio->isEmpty())
        {
            return response()->json(['message'=>'Solicitação não encontrado', 'data'=>'1'], 404);
        }
        else
        {
            return response()->json(['data'=>$correio]);
        }
    }

   
    public function edit(string $id)
    {
        $editar = $this->correio->where('id',$id)->get();

        return response()->json(['data'=>$editar]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualiza =  $request->only(['lote_numero', 'quadra']);
    
    $alteracao = DB::table('correio')
    ->where('id', $id)->update($atualiza);

    if($alteracao === 0){
        return response()->json(['message'=>'Registro não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Registro alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $Apagar = DB::table('correio')->where('id', $id)->first();

       if(!$Apagar){
        return response()->json(['message'=>'Registro não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('correio')->where('id', $id)->delete();
           return response()->json(['message'=>'Registro excluida com sucesso!']);
        }
    }
}
