<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class CategoryDish extends Model
{
    use CanFilterTrait;
    
    public $fillable = [
        'category_id',
        'dish_id',
    ];
}
