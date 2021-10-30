<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id','wallet'];

    public function marketer()
    {
        return $this->belongsTo('App\Marketer');
    }
}
