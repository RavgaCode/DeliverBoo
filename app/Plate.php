<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id',
        'cover'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
