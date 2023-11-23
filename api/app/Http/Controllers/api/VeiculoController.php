<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
{
    public readonly Veiculo $car;

    public function __construct(){

        $this->car = new Veiculo();
    }


    public function index()
    {
        $allCon = Veiculo::all();

        return response()->json(['data'=>$allCon]);
    }

       
    public function store(Request $request)
    {
                $car = DB::table('veiculo')->insert([
                'id_pessoa' => $request->input('id_pessoa'),
                'placa' => $request->input('placa'),
                'marca' => $request->input('marca'),
                'modelo' => $request->input('modelo'),
                'ano' => $request->input('ano'),
                'cor' => $request->input('cor')
                  ]);

            try{
                        if($car){
                        return response()->json(['message'=>'Veiculo cadastrado com sucesso', $car]);
                    }else{
                        return response()->json(['message'=>'Veiculo não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }
    }

   
    public function show(string $nome)
    {
        $car = DB::table('veiculo')->where('id_pessoa', $nome)->get();
        
        if($car->isEmpty())
        {
            return response()->json(['message'=>'Solicitação não encontrado', 'data'=>'1'], 404);
        }
        else
        {
            return response()->json(['data'=>$car]);
        }
    }

   
    public function edit(string $id)
    {
        $editar = $this->car->where('id',$id)->get();

        return response()->json(['data'=>$editar]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualiza =  $request->only(['id_pessoa','placa','marca','modelo','ano','cor']);
    
    $alteracao = DB::table('veiculo')
    ->where('id', $id)->update($atualiza);

    if($alteracao === 0){
        return response()->json(['message'=>'Registro não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Registro alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $Apagar = DB::table('veiculo')->where('id', $id)->first();

       if(!$Apagar){
        return response()->json(['message'=>'Registro não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('veiculo')->where('id', $id)->delete();
           return response()->json(['message'=>'Registro excluida com sucesso!']);
        }
    }
}
