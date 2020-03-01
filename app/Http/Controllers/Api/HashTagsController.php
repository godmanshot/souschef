<?php

namespace App\Http\Controllers\Api;

use App\Core\Menu\HashTag;
use Illuminate\Http\Request;
use App\Filters\HashTagFilter;
use App\Http\Controllers\Controller;

class HashTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, HashTagFilter $filter)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Core\Menu\HashTag  $hashTag
     * @return \Illuminate\Http\Response
     */
    public function show(HashTag $hashTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Core\Menu\HashTag  $hashTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HashTag $hashTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Core\Menu\HashTag  $hashTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(HashTag $hashTag)
    {
        //
    }
}
