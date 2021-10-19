<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = ['marketer_id','level1','level2','level3'];

    public function marketer()
    {
        return $this->belongsTo('App\marketer');
    }
}
