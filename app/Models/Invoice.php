<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

  
    protected $table = 'invoices';


    protected $fillable = [
        'cart_id',        
        'payment_date',   
        'payment_method', 
        'state',         
    ];

    
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
