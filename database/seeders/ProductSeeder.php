<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    
    public function run(): void
    {
        $product =new Product();

        $product->category_id = '3';
        $product->name = 'Camisa de Jeans';
        $product->price = 35000;
        $product->stock = 10;
        $product->image ='assets/images/Camisa.png';
        $product->description ='Elegancia y comodidad, ideal para cualquier ocasión, ya sea una salida casual o un evento formal.';
    
        $product->save();

        $product =new Product();

        $product->category_id = '3';
        $product->name = 'Jeans mujer';
        $product->price = 65000;
        $product->stock = 10;
        $product->image ='assets/images/jeans.png';
        $product->description = 'Jean mujer, diseñado para ofrecer un ajuste perfecto y resaltar tu figura.';

        $product->save();

        $product =new Product();

        $product->category_id = '1';
        $product->name = 'iPhone';
        $product->price = 500000;
        $product->stock = 10;
        $product->image ='assets/images/celular.png';
        $product->description ='La Notebook Banghó Max L5 i7 procesador Intel Core i7 de 12ª generación. ';

        $product->save(); 

        $product =new Product();

        $product->category_id = '2';
        $product->name = 'Cartera';
        $product->price = 50000;
        $product->stock = 10;
        $product->image ='assets/images/cartera.png';
        $product->description = 'Cartera de cuero de calidad';

        $product->save(); 

       
    }
}
