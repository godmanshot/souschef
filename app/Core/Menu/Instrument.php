<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'photo',
        'name'
    ];
}
