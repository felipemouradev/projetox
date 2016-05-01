<?php

namespace App\Http\Controllers\Repository;

use App\User;
use App\Http\Controllers\Repository\CrudRepository as Crud;

class UserRepository
{
    
    public function index()
    {
        return Crud::index(new User);
    }

    public function store($data)
    {
        return Crud::store($data,new User);
    }

    public function update($data,$id)
    {
        return Crud::update($data,new User,$id);
    }

    public function destroy($id)
    {
        return Crud::destroy($id,new User);
    }
    public function show($id)
    {
        return Crud::show($id,new User);
    }
}