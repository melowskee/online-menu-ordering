<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'email', 'name', 'address', 'city',
        'province', 'postalcode', 'phone', 'name_on_card', 'discount', 'discount_code', 'subtotal', 'tax', 'total', 'payment_gateway', 'error',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }
}
