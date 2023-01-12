<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class ProductList extends Component
{
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->products = ['salami pizza', 'hawai pizza', 'margarita pizza'];
        $this->products = Product::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-list');
    }
}
