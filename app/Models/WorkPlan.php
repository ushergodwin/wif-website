<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkPlan extends Model
{
    protected $fillable = ['title', 'year', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'year'      => 'integer',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(WorkPlanEvent::class)->orderBy('date')->orderBy('order');
    }
}
