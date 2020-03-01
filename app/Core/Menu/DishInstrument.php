<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class DishInstrument extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'dish_id',
        'instrument_id'
    ];
}
