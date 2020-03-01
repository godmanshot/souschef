<?php

namespace App\Http\Controllers\Api;

use App\Core\Menu\Dish;
use App\Core\Menu\Week;
use App\WeekCategoryDish;
use App\Core\Menu\Category;
use App\Filters\DishFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResource;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DishFilter $filter)
    {
        $dishes = DishResource::collection(Dish::filter($filter)->get());

        return $dishes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Core\Menu\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Core\Menu\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Core\Menu\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }

    public function sync(Week $week, Category $category, Dish $dish) {
        $week_id = $week->id;
        $category_id = $category->id;
        $dish_id = $dish->id;

        $last = WeekCategoryDish::selectRaw("MAX(`order`) as last_order")
        ->where('week_id', $week_id)
        ->where('category_id', $category_id)
            ->first();

        $order = $last ? $last->last_order+1 : 1;

        $model = WeekCategoryDish::updateOrCreate(
            ['week_id' => $week_id, 'category_id' => $category_id, 'dish_id' => $dish_id],
            ['order' => $order]
        );

        return $dish;
    }

    public function syncDelete(Request $request, Week $week, Category $category, Dish $dish)
    {
        $category_id = $category->id;
        $week_id = $week->id;
        $dish_id = $dish->id;

        $model = WeekCategoryDish::
            where('week_id', $week_id)
            ->where('category_id', $category_id)
            ->where('dish_id', $dish_id)
            ->first();
        
        $model ? $model->delete() : false;

        return $dish;
    }
}
