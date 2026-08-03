<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $fillable = [
        'subscription_id',
        'offer_id',
        'webmaster_id',
        'advertiser_id',
        'ip',
        'user_agent',
        'redirected',
        'amount',
        'commission',
        'webmaster_earning',
    ];

    protected function casts(): array
    {
        return [
            'redirected' => 'boolean',
            'amount' => 'decimal:2',
            'commission' => 'decimal:2',
            'webmaster_earning' => 'decimal:2',
        ];
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function webmaster()
    {
        return $this->belongsTo(User::class, 'webmaster_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_id');
    }
}
