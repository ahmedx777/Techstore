<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = [
    'user_id',
    'fullname',
    'address',
    'city',
    'phone',
    'payment_method',
    'total_price',
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
