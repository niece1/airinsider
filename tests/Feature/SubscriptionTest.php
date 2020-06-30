<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Subscription;
use Tests\Traits\AdminUser;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase, AdminUser;
    
    /** @test */
    public function a_user_can_subscribe_for_the_news()
    {
        $this->post('/subscriptions', [
            'email' => 'airinsider@gmail.com',
        ]);
      //  $response->assertRedirect('/dashboard/posts');
        $this->assertCount(1, Subscription::all());
    }
    
    /** @test */
    public function to_subscribe_you_need_to_enter_a_valid_email()
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
    public function to_subscribe_an_email_field_is_required()
    {
        $this->post('/subscriptions', [
            'email' => '',
        ])
                ->assertSessionHas('errors')
                ->assertStatus(302);
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['email'][0], 'Данное поле обязательно.');      
    }
    
    /** @test */
    public function subscription_can_be_deleted()
    {
        $this->post('/subscriptions', [
            'email' => 'airinsider@gmail.com',
        ]);
        $this->assertCount(1, Subscription::all());
        $this->actingAs($this->createAdminUser());
        $subscription = Subscription::first();        
        $this->delete('/dashboard/subscriptions/' . $subscription->id);
        $this->assertCount(0, Subscription::all());
        $this->assertDeleted($subscription);
    }
}
