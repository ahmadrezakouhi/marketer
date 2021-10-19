<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    protected $fillable = ['user_id','tel','address','national_code','status','parent_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function commission()
    {
        return $this->hasOne('App\Commission');
    }

}
