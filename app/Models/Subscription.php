<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'remember_token', 'subscribed'];

    /**
     * Add 'yes' if true and 'no' if false.
     *
     * @return string
     */
    public function getIfConfirmedAttribute()
    {
        return $this->subscribed == 0 ? 'No' : 'Yes';
    }
}
