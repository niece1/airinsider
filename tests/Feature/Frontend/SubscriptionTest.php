<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Subscription;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function aUserCanSubscribeForTheNews()
    {
        $this->post('/subscriptions', [
            'email' => 'airinsider@gmail.com',
        ]);
        $this->assertCount(1, Subscription::all());
    }
    
    /** @test */
    public function toSubscribeYouNeedToEnterAValidEmail()
    {
        $this->post('/subscriptions', [
            'email' => 'airinsider.gmail.com',
        ])
                ->assertSessionHas('errors')
                ->assertStatus(302);
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['email'][0], 'Поле должно быть корректным.');
    }
    
    /** @test */
    public function toSubscribeAnEmailFieldIsRequired()
    {
        $this->post('/subscriptions', [
            'email' => '',
        ])
                ->assertSessionHas('errors')
                ->assertStatus(302);
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['email'][0], 'Данное поле обязательно.');
    }
}
