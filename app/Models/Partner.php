<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'description',
        'website_url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function getLogoUrlAttribute(): ?string
    {
        $partnerLogo = $this->logo;

        if (empty($partnerLogo)) {
            return null;
        }

        /**
         * Handle JSON array string: ["path/to/logo.png"]
         */
        if (is_string($partnerLogo) && str_starts_with(trim($partnerLogo), '[')) {
            $decoded = json_decode($partnerLogo, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $partnerLogo = $decoded[0] ?? null;
            }
        }

        if (!$partnerLogo) {
            return null;
        }

        // Clean escaped slashes
        $partnerLogo = str_replace('\\', '', $partnerLogo);

        // Already a full URL
        if (str_starts_with($partnerLogo, 'http')) {
            return $partnerLogo;
        }

        // Stored on public disk
        if (Storage::disk('public')->exists($partnerLogo)) {
            return Storage::disk('public')->url($partnerLogo);
        }

        // Final fallback
        return asset('storage/' . ltrim($partnerLogo, '/'));
    }
}
