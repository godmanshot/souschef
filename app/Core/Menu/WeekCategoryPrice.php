<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class WeekCategoryPrice extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'week_category_id',
        'dishes_count',
        'person_count',
        'price',
    ];
}
