<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeekCategoryDish extends Model
{
    public $fillable = [
        'week_id',
        'category_id',
        'dish_id',
        'city_id',
        'order',
    ];
}
