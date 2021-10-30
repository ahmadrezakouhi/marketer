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

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function cards()
    {
        return $this->hasMany('App\Card');
    }


    public function marketers(){
        return $this->hasMany('App\Marketer','parent_id','id');
    }


    public function wallet()
    {
        return $this->hasOne('App\Wallet');
    }


    public function payments(){
        return $this->hasManyThrough('App\Payment','App\Card');
    }

}
