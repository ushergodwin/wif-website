<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'address',
        'email',
        'business_hours',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'tiktok_url',
        'facebook_url',
    ];

    /** Returns the single settings row, creating it with defaults if it doesn't exist. */
    public static function instance(): static
    {
        return static::firstOrCreate([], [
            'address'        => '',
            'email'          => '',
            'business_hours' => '',
        ]);
    }
}
