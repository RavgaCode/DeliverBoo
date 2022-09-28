<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'total_price',
    ];
    public function plate() {
        return $this->belongsToMany('App\Plate')
        ->withPivot('quantity');
    }
}
