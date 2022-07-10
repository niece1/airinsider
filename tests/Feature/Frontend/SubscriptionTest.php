<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Http\Livewire\Subscriptions;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function mainPageContainsSubscriptionFormLivewireComponent()
    {
        $this->get('/')
            ->assertSeeLivewire('subscriptions');
    }

    /** @test */
    public function aUserCanSubscribeForTheNewsletterEmail()
    {
        Livewire::test(Subscriptions::class)
            ->set('email', 'airinsider@gmail.com')
            ->call('store')
            ->assertSet('email', 'airinsider@gmail.com');
    }

    /** @test */
    public function toSubscribeYouNeedToEnterAValidEmail()
    {
        Livewire::test(Subscriptions::class)
            ->set('email', 'airinsider')
            ->call('store')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    public function toSubscribeAnEmailFieldIsRequired()
    {
        Livewire::test(Subscriptions::class)
            ->set('email', '')
            ->call('store')
            ->assertHasErrors(['email' => 'required']);
    }
}
