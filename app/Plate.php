<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'restaurant_id',
        'cover'
    ];
}
