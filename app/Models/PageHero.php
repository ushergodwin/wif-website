<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageHero extends Model
{
    protected $fillable = [
        'page_slug',
        'image',
        'overlay_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        
        return asset('storage/' . $this->image);
    }
}
