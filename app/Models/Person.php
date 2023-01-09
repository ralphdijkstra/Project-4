<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    // every person has a user account and when user is created, person is created with same id
    protected $guarded = [];

    public function pizzaPoint()
    {
        return $this->hasMany(PizzaPoint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
