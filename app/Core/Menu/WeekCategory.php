<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class WeekCategory extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'week_id',
        'category_id',
        'is_hit',
        'order',
    ];
}
