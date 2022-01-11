<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerSurgery extends Pivot
{
    protected $fillable = ['customer_id','surgery_id','status','price','adviser_id'];


    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function adviser(){
        return $this->belongsTo('App\User','adviser_id');
    }

    public function surgery(){
        return $this->belongsTo('App\Surgery');
    }
}
