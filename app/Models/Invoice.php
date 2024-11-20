<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'payment_date',
        'payment_method',
        'state',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
