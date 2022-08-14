<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Http\Livewire\Subscription;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function mainPageContainsSubscriptionFormLivewireComponent()
    {
        $this->get('/')
            ->assertSeeLivewire('subscription');
    }

    /** @test */
    public function aUserCanSubscribeForTheNewsletterEmail()
    {
        Livewire::test(Subscription::class)
            ->set('email', 'airinsider@gmail.com')
            ->call('store')
            ->assertSet('email', 'airinsider@gmail.com');
    }

    /** @test */
    public function toSubscribeYouNeedToEnterAValidEmail()
    {
        Livewire::test(Subscription::class)
            ->set('email', 'airinsider')
            ->call('store')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    public function toSubscribeAnEmailFieldIsRequired()
    {
        Livewire::test(Subscription::class)
            ->set('email', '')
            ->call('store')
            ->assertHasErrors(['email' => 'required']);
    }
}
