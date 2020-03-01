<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'name',
        'shelf_life',
        'weight',
        'cooking_time',
        'cooking_difficulty',
        'energy_value',
        'protein',
        'fat',
        'carbohydrates',
        'description',
        'recipe',
    ];

    public function hashTags()
    {
        return $this->belongsToMany('App\Core\Menu\HashTag', 'dish_hash_tags');
    }
}
