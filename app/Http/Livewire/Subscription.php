<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscription as SubscriptionModel;
use Illuminate\Support\Str;
use Lukeraymonddowning\Honey\Traits\WithHoney;
use App\Jobs\SendSubscriptionConfirmationMailJob;

class Subscription extends Component
{
    use WithHoney;

    /**
     * Input field in subscriptions component.
     */
    public $email;

    /**
     * Checkbox boolean field.
     */
    public $terms;

    /**
     * Validation rules.
     */
    protected $rules = [
        'email' => 'required|email|unique:subscriptions,email|max:30',
        'terms' => 'required',
    ];

    /**
     * Display subscription component.
     *
     * @return view livewire component
     */
    public function render()
    {
        return view('livewire.subscription');
    }

    /**
     * Add subscription email to the database.
     *
     * @return void
     */
    public function store()
    {
        $this->validate();
        if ($this->honeyPasses()) {
            $subscription = SubscriptionModel::create([
                'email' => $this->email,
                'remember_token' => Str::random(16)
            ]);
            dispatch(new SendSubscriptionConfirmationMailJob($subscription));
            session()->flash('success', 'We just sent you a confirmation email. Proceed to confirm');
        }
    }
}
