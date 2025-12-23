<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvisoryBoardMember extends Model
{
    protected $fillable = [
        'name',
        'title',
        'photo',
        'is_active',
        'order',
    ];

    protected $casts = [
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
