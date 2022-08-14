<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Subscription as SubscriptionModel;
use Tests\Traits\AdminUser;
use Livewire\Livewire;
use App\Http\Livewire\Subscription;
use Illuminate\Support\Str;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    /** @test */
    public function subscriptionCanBeDeleted()
    {
        Livewire::test(Subscription::class)
            ->set('email', 'airinsider@gmail.com')
            ->set('terms', true)
            ->call('store')
            ->assertSet('email', 'airinsider@gmail.com');
        
        $this->actingAs($this->createAdminUser());
        $subscription = SubscriptionModel::first();
        $this->delete('/dashboard/subscriptions/' . $subscription->id);
        $this->assertCount(0, SubscriptionModel::all());
        $this->assertModelMissing($subscription);
    }
}
