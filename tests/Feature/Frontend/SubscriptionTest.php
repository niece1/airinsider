<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Subscription;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function aUserCanSubscribeForTheNewsletterEmail()
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
        $this->assertEquals($messages['email'][0], 'The email must be a valid email address.');
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
        $this->assertEquals($messages['email'][0], 'The email field is required.');
    }
}
