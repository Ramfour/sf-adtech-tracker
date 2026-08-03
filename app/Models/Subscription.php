<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
    protected $fillable = [
        'webmaster_id',
        'offer_id',
        'price_per_click',
        'token',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price_per_click' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Subscription $subscription) {
            if (empty($subscription->token)) {
                $subscription->token = Str::random(32);
            }
        });
    }

    public function webmaster()
    {
        return $this->belongsTo(User::class, 'webmaster_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }
}
