<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimentacaoController extends Controller
{
    
    public readonly Movimentacao $movimentacao;

    public function __construct(){

        $this->movimentacao = new Movimentacao();
    }


    public function index()
    {
        $allCon = Movimentacao::all();

        return response()->json(['data'=>$allCon]);
    }

       
    public function store(Request $request)
    {
                $movimentacao = DB::table('movimentacao')->insert([
                'id_portaria' => $request->input('id_portaria'),
                'id_pessoa' => $request->input('id_pessoa'),
                'tipo_movimentacao' => $request->input('tipo_movimentacao'),
                'observacoes' => $request->input('observacoes'),
                'id_veiculo' => $request->input('id_veiculo'),
                'id_autorizacao_agenda' => $request->input('id_autorizacao_agenda'),
                'id_local' => $request->input('id_local')
                  ]);

            try{
                        if($movimentacao){
                        return response()->json(['message'=>'Movimentação registrada com sucesso', $movimentacao]);
                    }else{
                        return response()->json(['message'=>'Movimentação não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }
    }

   
    public function show(string $nome)
    {
        $mostrar = DB::table('movimentacao')->where('id_pessoa', $nome)->get();
        
        if($mostrar->isEmpty())
        {
            return response()->json(['message'=>'Solicitação não encontrado', 'data'=>'1'], 404);
        }
        else
        {
            return response()->json(['data'=>$mostrar]);
        }
    }

   
    public function edit(string $id)
    {
        $editar = $this->movimentacao->where('id',$id)->get();

        return response()->json(['data'=>$editar]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualiza =  $request->only(['id_portaria','id_pessoa','tipo_movimentacao','observacoes','id_veiculo','id_autorizacao_agenda', 'id_local']);
    
    $alteracao = DB::table('movimentacao')
    ->where('id', $id)->update($atualiza);

    if($alteracao === 0){
        return response()->json(['message'=>'Registro não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Registro alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $Apagar = DB::table('movimentacao')->where('id', $id)->first();

       if(!$Apagar){
        return response()->json(['message'=>'Registro não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('movimentacao')->where('id', $id)->delete();
           return response()->json(['message'=>'Registro excluida com sucesso!']);
        }
    }
}
