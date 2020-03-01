<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class DishHashTag extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'dish_id',
        'hash_tag_id'
    ];
}
