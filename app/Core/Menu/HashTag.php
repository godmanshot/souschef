<?php

namespace App\Core\Menu;

use App\Filters\CanFilterTrait;
use Illuminate\Database\Eloquent\Model;

class HashTag extends Model
{
    use CanFilterTrait;

    public $fillable = [
        'name'
    ];
}
