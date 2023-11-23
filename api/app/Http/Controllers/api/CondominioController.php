<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Condominio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CondominioController extends Controller
{
   
    public readonly Condominio $condominio;

    public function __construct(){

        $this->condominio = new Condominio();
    }


    public function index()
    {
        $allCon = Condominio::all();

        return response()->json(['data'=>$allCon]);
    }

       
    public function store(Request $request)
    {
                $condominio = DB::table('condominio')->insert([
                'lote_numero' => $request->input('lote_numero'),
                'quadra' => $request->input('quadra')
                
            ]);

            try{
                        if($condominio){
                        return response()->json(['message'=>'Lote criado com sucesso', $condominio]);
                    }else{
                        return response()->json(['message'=>'Lote não pode ser criada'], 404);

                    }
            }catch(\Exception $e){

                return response()->json(['Erro'=>'Erro de conexão, ', $e->getMessage()], 500);

            }



    }

   
    public function show($id)
    {
        $condominio = DB::table('condominio')->where('lote_numero', $id)->get();
        
        if($condominio->isEmpty())
        {
            return response()->json(['message'=>'Solicitação não encontrado'], 404);
        }
        else
        {
            return response()->json(['data'=>$condominio]);
        }
    }

   
    public function edit(string $id)
    {
        $editar = $this->condominio->where('id',$id)->get();

        return response()->json(['data'=>$editar]);
    }

   
    public function update(Request $request, string $id)
    {
        $atualiza =  $request->only(['lote_numero', 'quadra']);
    
    $alteracao = DB::table('condominio')
    ->where('id', $id)->update($atualiza);

    if($alteracao === 0){
        return response()->json(['message'=>'Registro não encontrado ou nenhum campo alterado !'], 404);
    }else{
        return response()->json(['message'=>'Registro alterado com sucesso!']);
    }
    }

    
    public function destroy($id)
    {
       $Apagar = DB::table('condominio')->where('id', $id)->first();

       if(!$Apagar){
        return response()->json(['message'=>'Registro não encontrado ou cadastrada!'], 404);
       }else{
           DB::table('condominio')->where('id', $id)->delete();
           return response()->json(['message'=>'Registro excluida com sucesso!']);
        }
    }
}
