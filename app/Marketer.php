<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    protected $fillable = ['user_id','tel','address','national_code','status','parent_id'];
}
