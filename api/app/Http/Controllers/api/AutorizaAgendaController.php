<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AutorizacaoAgenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutorizaAgendaController extends Controller
{
    
    public readonly AutorizacaoAgenda $AutorizaAgenda;

    public function __construct(){

        $this->AutorizaAgenda = new AutorizacaoAgenda();
    }


    public function index()
    {
        $AutorizaAgenda = AutorizacaoAgenda::all();

        return response()->json(['data'=>$AutorizaAgenda]);
    }

       
    public function store(Request $request)
    {
                $AutorizaAgenda = DB::table('autorizacao_agenda')->insert([
                'id_pessoa_autoriza' => $request->input('id_pessoa_autoriza'),
                'id_pessoa_entrada' => $request->input('id_pessoa_entrada'),
                'observacao' => $request->input('observacao'),
                'hora_data' => $request->input('hora_data'),
                'tipo_autorizacao_agenda' => $request->input('tipo_autorizacao_agenda'),
                'id_veiculo' => $request->input('id_veiculo'),
                'id_portaria' => $request->input('id_portaria')
            ]);

            try{
                        if($AutorizaAgenda){
                        return response()->json(['message'=>'Autorização ou Agendamento criado com sucesso', $AutorizaAgenda]);
                    }else{
                        return response()->json(['message'=>'Autorização ou Agendamento não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }



    }

   
    public function show(string $nome)
    {
        $AutorizaAgenda = DB::table('autorizacao_agenda')->where('id_pessoa_entrada','like','%'.$nome.'%')->get();
        return response()->json(['data'=>$AutorizaAgenda]);
    }

   
    public function edit(string $id)
    {
        $AutorizaAgenda = $this->AutorizaAgenda->where('id',$id)->get();

        return response()->json(['data'=>$AutorizaAgenda]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualiza =  $request->only(['id_pessoa_entrada', 'id_pessoa_autoriza','observacao','hora_data', 'tipo_autorizacao_agenda','id_veiculo','id_portaria']);
    
    $alteracao = DB::table('autorizacao_agenda')
    ->where('id', $id)->update($atualiza);

    if($alteracao === 0){
        return response()->json(['message'=>'Registro não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Registro alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $AutorizaAgenda = DB::table('autorizacao_agenda')->where('id', $id)->first();

       if(!$AutorizaAgenda){
        return response()->json(['message'=>'Autorização ou Agendamento não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('autorizacao_agenda')->where('id', $id)->delete();
           return response()->json(['message'=>'Autorização ou Agendamento excluida com sucesso!']);
        }
    }
}
