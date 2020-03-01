<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Core\Menu\Week;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function testExample()
    {
        $week = factory(Week::class)->create();

        $response = $this->get(route('menu'));
        
        $response->assertStatus(200);
    }
}
