<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Subscription;
use Tests\Traits\AdminUser;
use Livewire\Livewire;
use App\Http\Livewire\Subscriptions;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    /** @test */
    public function subscriptionCanBeDeleted()
    {
        Livewire::test(Subscriptions::class)
            ->set('email', 'airinsider@gmail.com')
            ->call('store')
            ->assertSet('email', 'airinsider@gmail.com');
        
        $this->actingAs($this->createAdminUser());
        $subscription = Subscription::first();
        $this->delete('/dashboard/subscriptions/' . $subscription->id);
        $this->assertCount(0, Subscription::all());
        $this->assertModelMissing($subscription);
    }
}
