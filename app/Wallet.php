<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['marketer_id','amount'];

    public function marketer()
    {
        return $this->belongsTo('App\Marketer');
    }
}
