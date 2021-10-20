<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['marketer_id','surgery_id','name','last_name','gender','age','tel','phone','address'];

    public function marketer()
    {
        return $this->belongsTo('App\Marketer');
    }

}
