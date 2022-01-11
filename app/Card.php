<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'marketer_id', 'bank_id', 'name', 'last_name',
        'national_code', 'identification', 'status', 'price'
    ];


    public function marketer()
    {
        return $this->belongsTo('App\Marketer');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function payments()
    {
        $this->hasMany('App\Payment');
    }
}
