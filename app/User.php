<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username','f_name','l_name','email','password'];
    protected $hidden =['password'];
    public function chains(){
        return $this->hasMany('App\Chain');
    }
}
