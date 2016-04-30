<?php

namespace App\Http\Controllers;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public $message = [
        "MESSAGE_SUCCESS_SAVE" => "Salvo com sucesso!",
        "MESSAGE_SUCCESS_UPDATE"=>"Atualizado com sucesso!",
        "MESSAGE_ERROR_SAVE"=>"Falha ao Salvar",
        "MESSAGE_ERROR_UPDATE"=>"Falha ao Atualizar",
        "MESSAGE_SUCCESS_DESTROY"=>"Deletado com sucesso!",
        "MESSAGE_ERROR_DESTROY"=>"Falha ao deletar!",

        "MESSAGE_ERROR_SHOW"=>"Não existe!",
    ];

    public function validatorFields($table,$data,$exp = null)
    {
        $exp = array_merge($exp,['id', 'created_at','updated_at']);
        $response = [];
        $columns = \Schema::getColumnListing($table);
        foreach($columns as $v){
            if(in_array($v,$exp)){
                continue;
            }
            if(empty($data[$v])) {
                $response[] = "Favor preencher ".$v;
            }
            $type = \DB::connection()->getDoctrineColumn($table, $v)->getType()->getName();
            $test = $this->testType($type,$data[$v]);
            if(!$test){
                $response[] = $v." é inválido";
            }
        }
        return $response;
    }
    protected function testType($type, $data)
    {
        if($type == 'integer'){
            return is_int($data) ? true : false;
        }
        elseif(in_array($type,['float','double'])){
            return is_float($data) ? true : false;
        }
        elseif(in_array($type,['string','text'])){
            return is_string($data) ? true : false;
        }
    }
    public function returnJson($data,$code,$msg="response")
    {
        return response()->json([$msg=>$data],$code);
    }
}
