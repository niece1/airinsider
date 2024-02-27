<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Subscription;
use Tests\Traits\AdminUser;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    /** @test */
    public function subscriptionCanBeDeleted()
    {
         $this->post('/subscriptions', [
            'email' => 'airinsider@gmail.com',
        ]);
        $this->assertCount(1, Subscription::all());
        
        $this->actingAs($this->createAdminUser());
        $subscription = Subscription::first();
        $this->delete('/dashboard/subscriptions/' . $subscription->id);
        $this->assertCount(0, Subscription::all());
        $this->assertModelMissing($subscription);
    }
}
