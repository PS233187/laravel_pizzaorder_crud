<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'size_id'
    ];


    public function size()
    {
        return $this->belongsTo(Size::class);
    }

  public function toppings()
  {
    return $this->belongsToMany(Topping::class);
  }

  public function toppingsNotAttached()
{
    return Topping::wheredoesnthave('products', function($query) {
       $query->where('products.id', $this->id);
    })->get();
}
}

