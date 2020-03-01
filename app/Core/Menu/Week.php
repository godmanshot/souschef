<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'name',
        'start_at',
        'end_at',
    ];
    
    protected $dates = [
        'start_at',
        'end_at',
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Core\Menu\Category', 'week_categories')->withPivot('is_hit', 'order');
    }
}
