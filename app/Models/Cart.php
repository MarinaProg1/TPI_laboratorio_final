<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_carts')->withPivot('quantity');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($cart) {
            if (!$cart->user_id) {
                $cart->user_id = Auth::id(); // Asignar el user_id del usuario autenticado
            }
        });
    }
}


