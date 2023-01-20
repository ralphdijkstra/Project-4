<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Ingredient extends Model
{
    use HasFactory;
    protected $table = 'product_ingredient';
    public $timestamps = false;
}
