<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chain extends Model
{
    protected $fillable = ['user_id','date_time','duration','completed',];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
