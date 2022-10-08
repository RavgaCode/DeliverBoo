<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_telephone',
        'total_price',
        'cart',
        'user_id',
    ];
    public function plate() {
        return $this->belongsToMany('App\Plate')
        ->withPivot('quantity');
    }
}
