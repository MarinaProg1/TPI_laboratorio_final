<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_date',
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
