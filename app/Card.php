<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillabale = ['marketer_id','bank_id','identification','status'];
}
