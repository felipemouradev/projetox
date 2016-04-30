<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = "users";
    protected $guarded = ['id'];
    protected $hidden = ['password'];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = sha1($value);
    }
}
