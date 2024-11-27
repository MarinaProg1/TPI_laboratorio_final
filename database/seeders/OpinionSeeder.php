<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Opinion;
use App\Models\Product;
use App\Models\User; 

class OpinionSeeder extends Seeder
{
    public function run(): void
    {
      
        $products = Product::all();

    
        $userIds = User::whereIn('email', ['usuarioUno@gmail.com', 'usuarioDos@gmail.com', 'usuarioTres@gmail.com'])->pluck('id');

      
        foreach ($products as $product) {
          
            foreach ($userIds as $userId) {
                
                Opinion::create([
                    'qualification' => rand(1, 5), 
                    'comment' => 'Comentario de prueba para el producto ' . $product->name, 
                    'date' => now(), 
                    'product_id' => $product->id,
                    'user_id' => $userId, 
                ]);
            }
        }
    }
}
