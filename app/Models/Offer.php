<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'advertiser_id',
        'name',
        'target_url',
        'price_per_click',
        'topics',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price_per_click' => 'decimal:2',
        ];
    }

    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }
}
