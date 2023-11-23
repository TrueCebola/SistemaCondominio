<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoteController extends Controller
{
   
    public readonly Lote $lote;

    public function __construct(){

        $this->lote = new Lote();
    }


    public function index()
    {
        $allCon = Lote::all();

        return response()->json(['data'=>$allCon]);
    }

       
    public function store(Request $request)
    {
                $lote = DB::table('lote')->insert([
                'id_pessoa' => $request->input('id_pessoa'),
                'estado' => $request->input('estado'),
                'id_lote' => $request->input('id_lote')
                  ]);

            try{
                        if($lote){
                        return response()->json(['message'=>'Lote criado com sucesso', $lote]);
                    }else{
                        return response()->json(['message'=>'Lote não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }
    }

   
    public function show(string $nome)
    {
        $lote = DB::table('lote')->where('id_pessoa', $nome)->get();
        
        if($lote->isEmpty())
        {
            return response()->json(['message'=>'Solicitação não encontrado', 'data'=>'1'], 404);
        }
        else
        {
            return response()->json(['data'=>$lote]);
        }
    }

   
    public function edit(string $id)
    {
        $editar = $this->lote->where('id',$id)->get();

        return response()->json(['data'=>$editar]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualiza =  $request->only(['estado', 'id_pessoa', 'id_lote']);
    
    $alteracao = DB::table('lote')
    ->where('id', $id)->update($atualiza);

    if($alteracao === 0){
        return response()->json(['message'=>'Registro não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Registro alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $Apagar = DB::table('lote')->where('id', $id)->first();

       if(!$Apagar){
        return response()->json(['message'=>'Registro não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('lote')->where('id', $id)->delete();
           return response()->json(['message'=>'Registro excluida com sucesso!']);
        }
    }
}
