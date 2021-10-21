<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillabale = ['marketer_id','bank_id','identification','status'];


    public function marketer()
    {
        return $this->belongsTo('App\Marketer');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

}
