<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class CategoryPrice extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'category_id',
        'dishes_count',
        'person_count',
        'price',
    ];
}
