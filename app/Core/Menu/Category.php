<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CanFilterTrait;
    
    public $fillable = [
        'name',
    ];

    public function dishes()
    {
        return $this->belongsToMany('App\Core\Menu\Dish', 'week_category_dishes');
    }
}
