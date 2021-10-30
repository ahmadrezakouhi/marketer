<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['card_id','amount','status'];

    public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function marketer()
    {
        return $this->hasManyThrough('App\Marketer','App\Card');
    }
}
