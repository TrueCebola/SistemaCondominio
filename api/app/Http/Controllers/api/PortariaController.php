<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Portarium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Js;
use Symfony\Component\Console\Input\Input;

class PortariaController extends Controller
{
    
    public readonly Portarium $portaria;

    public function __construct(){

        $this->portaria = new Portarium();
    }


    public function index()
    {
        //listar todas as portarias

        $portarias = Portarium::all();

        return response()->json(['data'=>$portarias]);
    }
   
    public function store(Request $request)
    {
                $portaria = DB::table('portaria')->insert([
                'portaria_nome' => $request->input('portaria_nome'),
                'id_pessoa_funcionario' => $request->input('id_pessoa_funcionario'),
                'turno_trabalho' => $request->input('turno_trabalho'),
                'active' => $request->input('active')
            ]);

            try{
                        if($portaria){
                        return response()->json(['message'=>'Portaria criada com sucesso', $portaria]);
                    }else{
                        return response()->json(['message'=>'Portaria não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }

    }
   
    public function show(string $nome)
    {
        $portarias = DB::table('portaria')->where('portaria_nome','like','%'.$nome.'%')->get();
        return response()->json(['portaria'=>$portarias]);
    }

   
    public function edit(string $id)
    {
        $portaria = $this->portaria->where('id',$id)->get();

        return response()->json(['data'=>$portaria]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualizaPortaria =  $request->only(['portaria_nome', 'id_pessoa_funcionario','turno_trabalho','active']);
    
    $alteracao = DB::table('portaria')
    ->where('id', $id)->update($atualizaPortaria);

    if($alteracao === 0){
        return response()->json(['message'=>'Registro não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Registro alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $portaria = DB::table('portaria')->where('id', $id)->first();

       if(!$portaria){
        return response()->json(['message'=>'Portaria não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('portaria')->where('id', $id)->delete();
           return response()->json(['message'=>'Portaria excluida com sucesso!']);
        }
    }
}
