<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
