<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function aboutPageWorksCorrectly()
    {
        $this->get('/about')
                ->assertStatus(200)
                ->assertSeeText('Who we are');
    }
}
