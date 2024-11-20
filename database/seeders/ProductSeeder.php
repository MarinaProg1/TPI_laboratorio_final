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
        $product->image ='images/Camisa.png';
        $product->description ='Esta camisa de hombre combina elegancia y comodidad, ideal para cualquier ocasión, ya sea una salida casual o un evento formal.';
    
        $product->save();

        $product =new Product();

        $product->category_id = '3';
        $product->name = 'Jeans mujer';
        $product->price = 65000;
        $product->stock = 10;
        $product->image ='images/JeanMujer.png';
        $product->description = 'Jean mujer, diseñado para ofrecer un ajuste perfecto y resaltar tu figura.';

        $product->save();

        $product =new Product();

        $product->category_id = '1';
        $product->name = 'iPhone';
        $product->price = 500000;
        $product->stock = 10;
        $product->image ='images/iPhone.png';
        $product->description ='La Notebook Banghó Max L5 i7 procesador Intel Core i7 de 12ª generación, 8GB de RAM y un disco SSD de 480GB, ideal para tareas exigentes y almacenamiento rápido. ';

        $product->save(); 

        $product =new Product();

        $product->category_id = '2';
        $product->name = 'Cartera';
        $product->price = 50000;
        $product->stock = 10;
        $product->image ='images/Cartera.png';
        $product->description = 'Cartera de cuero de calidad';

        $product->save(); 

       
    }
}
