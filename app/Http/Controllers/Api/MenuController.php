<?php

namespace App\Http\Controllers\Api;

use App\Core\Menu\Week;
use App\Filters\WeekFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WeekResource;
use App\Http\Resources\WeekCollection;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $models = WeekResource::collection(Week::get());

        return $models;
    }

}
