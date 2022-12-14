<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'restaurant_name',
        'restaurant_vat',
        'restaurant_address',
        'restaurant_cover',
        'slug',
        'category_id',
        'restaurant_description',
        'restaurant_days',
        'restaurant_hours',
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

    public function category(){
        return $this->belongsToMany('App\Category');
    }

    public function plates(){
        return $this->belongsToMany('App\Plate');
    }

    public function getId(){
        return $this->id;
    }
}
