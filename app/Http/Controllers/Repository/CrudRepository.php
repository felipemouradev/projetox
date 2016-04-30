<?php

namespace App\Http\Controllers\Repository;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;

class CrudRepository //extends Controller
{

    public static function index($model)
    {
        return $model::all();
    }

    public static function store($data, $model)
    {
        $controller = new Controller;

        $test = $controller->validatorFields($model['table'],$data,['active']);
    
        if(empty($test)) {
            $save = $model::create($data);
            if($save){
                return true;
            }
            return false;
        }
        return $test;
    }

    public static function update($data, $model, $id)
    {
        $controller = new Controller;

        $test = $controller->validatorFields($model['table'],$data,['active']);

        if(empty($test)) {

            $update = $model::find($id)->update($data);
            if($update){
                return true;
            }
            return false;
        }
        return $test;
    }
    public static function destroy($id,$model){

        $del = $model::destroy($id);
        return (bool) $del;
    }
    public static function show($id,$model)
    {
        $show = $model::find($id);
        return $show;
    }
}
