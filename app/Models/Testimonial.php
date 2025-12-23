<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'participant_name',
        'role',
        'program_attended',
        'testimonial_text',
        'photo',
        'video_url',
        'is_featured',
        'is_active',
        'order',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }

        return asset('storage/' . $this->photo);
    }
}
