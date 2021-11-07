<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerSurgery extends Pivot
{
    protected $fillable = ['customer_id','surgery_id','status','price'];
}
