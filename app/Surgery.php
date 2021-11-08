<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $fillable = ['name'];

    public function customers()
    {
        return $this->belongsToMany('App\Customer')->using("App\CustomerSurgery");
    }

}
