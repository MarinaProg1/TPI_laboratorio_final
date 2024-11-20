<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories =new Category();

        $categories->name = 'Electronicos';
        $categories->description = 'Dispositivos, gadgets y accesorios.';
        
        $categories->save();

        $categories =new Category();

        $categories->name = 'Accesorios';
        $categories->description ='Complementos y artículos para uso personal o acompañar otros productos.' ;
        
        $categories->save();

        $categories =new Category();

        $categories->name = 'Ropas';
        $categories->description = 'Prendas de vestir para todas las edades y estilos, desde ropa casual hasta opciones formales.';
        
        $categories->save();
       
        
    }
}
