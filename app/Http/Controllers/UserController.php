<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\UserRepository;
use App\Http\Requests;

class UserController extends Controller
{
    //
    public function index()
    {
        return response()->json((new UserRepository)->index());
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $save = (new UserRepository)->store($data);
        if(!is_array($save)){
            if($save) return $this->returnJson(['message'=>$this->message['MESSAGE_SUCCESS_SAVE']], 200);
            return $this->returnJson(['message' => $this->message['MESSAGE_ERROR_SAVE'] ], 403);    
        }
        return $this->returnJson(['message'=>$save],403);
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();

        $update = (new UserRepository)->update($data,$id);
        if(!is_array($update)){
            if($update) return $this->returnJson(['message'=>$this->message['MESSAGE_SUCCESS_UPDATE']], 200);
            return $this->returnJson(['message' => $this->message['MESSAGE_ERROR_UPDATE'] ], 403);
        }
        return $this->returnJson(['message'=>$update],403);
    }

    public function destroy($id)
    {
        $del = (new UserRepository)->destroy($id);
        if($del) return $this->returnJson(['message'=>$this->message['MESSAGE_SUCCESS_DESTROY']], 200);
        return $this->returnJson(['message' => $this->message['MESSAGE_ERROR_DESTROY'] ], 403);
    }

    public function show($id)
    {
        $show = (new UserRepository)->show($id);
        if($show) return $this->returnJson($show, 200);
        return $this->returnJson(['message' => $this->message['MESSAGE_ERROR_SHOW'] ], 403);
    }
}
