<?php
namespace App\View\Components;

use Illuminate\View\Component;

class CategoriesCom extends Component
{
    public $category;

    // Constructor para recibir la categoría
    public function __construct($category)
    {
        $this->category = $category;
    }

    // Método para renderizar la vista del componente
    public function render()
    {
        return view('components.categories-com');
    }
}
