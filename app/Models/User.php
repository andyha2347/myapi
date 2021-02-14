<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function userAddress(){
        return $this->hasOne(UserAddress::class, 'user_id', 'id');
    }
    public function product(){
        return $this->hasMany(Product::class, 'user_id', 'id');
    }
//    public function getAddressRelation(){
//        return $this->hasOne('App\Models\UserAddress', 'user_id', 'id');
//    }

//    public function getPostRelation(){
//        return $this->hasMany('App\Post', 'user_id', 'id');
//    }
//
//    public function getRolesRelation(){
//        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
//    }
}
