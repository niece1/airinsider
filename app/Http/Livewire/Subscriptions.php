<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Support\Str;
use Lukeraymonddowning\Honey\Traits\WithHoney;

class Subscriptions extends Component
{
    use WithHoney;

    /**
     * Input field in subscriptions component.
     */
    public $email;

    /**
     * Checkbox boolean field.
     */
    public $confirmTerms;

    /**
     * Display subscriptions component.
     *
     * @return view livewire component
     */
    public function render()
    {
        return view('livewire.subscriptions');
    }

    /**
     * Add subscription email to the database.
     *
     * @return void
     */
    public function store()
    {
        $this->validate((new SubscriptionRequest())->rules());
        if ($this->honeyPasses()) {
            Subscription::create([
                'email' => $this->email,
                'remember_token' => Str::random(16)
            ]);
            session()->flash('success', 'You are subscribed!');
        }
    }
}
