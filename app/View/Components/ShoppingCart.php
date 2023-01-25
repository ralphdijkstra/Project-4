<?php

namespace App\View\Components;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\View\Component;

class ShoppingCart extends Component
{
    public $products;
    public $ingredients;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->products = Product::all();
        $this->ingredients = Ingredient::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shopping-cart');
    }
}
