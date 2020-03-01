<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'photo',
        'name',
        'shelf_time',
        'storage_conditions',
        'manufacturer',
        'energy_value',
        'protein',
        'fat',
        'carbohydrates',
        'manufacturer_country_id',
    ];
}
