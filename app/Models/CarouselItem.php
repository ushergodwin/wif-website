<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselItem extends Model
{
    protected $fillable = [
        'image',
        'overlay_text',
        'button_text',
        'button_url',
        'is_active',
        'order',
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
