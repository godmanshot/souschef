<?php

namespace App\Http\Controllers\Api;

use App\Core\Menu\Week;
use App\Core\Menu\Category;
use App\Filters\WeekFilter;
use Illuminate\Http\Request;
use App\Core\Menu\WeekCategory;
use App\Http\Controllers\Controller;

class WeeksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, WeekFilter $filter)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $last_week = Week::orderBy('end_at', 'desc')->first();

        $new_start = $last_week->end_at->addDays(2)->startOfWeek();
        $new_end = $last_week->end_at->addDays(2)->endOfWeek();

        $model = Week::create([
            'name' => $new_start->format('d.m').' - '.$new_end->format('d.m'),
            'start_at' => $new_start,
            'end_at' => $new_end,
        ]);
        
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Core\Menu\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function show(Week $week)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Core\Menu\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Week $week)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Core\Menu\Week  $week
     * @return \Illuminate\Http\Response
     */
    public function destroy(Week $week)
    {
        $week->delete();
    }

    public function sync(Request $request, Week $week, Category $category)
    {
        $category_id = $category->id;
        $week_id = $week->id;

        $last = WeekCategory::selectRaw("MAX(`order`) as last_order")
            ->where('week_id', $week_id)
            ->first();

        $order = $last ? $last->last_order+1 : 1;

        $week->categories()->syncWithoutDetaching([$category_id => ['order' => $order]]);
        
        $week->save();

        $new_model = $week->categories()->wherePivot('category_id', $category_id)->first();

        return $new_model;
    }

    public function syncDelete(Request $request, Week $week, Category $category)
    {
        $category_id = $category->id;
        $week_id = $week->id;

        $week->categories()->detach($category_id);
        
        $week->save();

        return $category;
    }

    
}
