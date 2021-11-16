<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name','email','phone','role_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFullNameAttribute()
    {
        return $this->name . ' '.$this->last_name;
    }


    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function marketer(){
        return $this->hasOne('App\Marketer');
    }

    public function isSuperAdmin(){
        if($this->role->name == 'super_admin'){
            return true;
        }
        return false;
    }

    public function isAdmin(){
        if($this->role->name =="admin"){
           return true;
        }
        return false;
    }



    public function isSeller(){
        if($this->role->name == 'seller'){
            return true;
        }
        return false;
    }


    public function isAccountant()
    {
        if($this->role->name == 'accountant'){
            return true;
        }
        return false;
    }

    public function isAdviser(){
        if($this->role->name == 'adviser'){
            return true;
        }

        return false;
    }


    public function isMarketer()
    {
        if($this->role->name == 'marketer'){
            return true;
        }
        return false;
    }



}
