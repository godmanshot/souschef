<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class DishIngredient extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'dish_id',
        'ingredient_id',
        'count'
    ];
}
