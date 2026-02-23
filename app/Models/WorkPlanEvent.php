<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkPlanEvent extends Model
{
    protected $fillable = ['work_plan_id', 'title', 'date', 'location', 'theme', 'description', 'order'];

    protected $casts = [
        'date'  => 'date',
        'order' => 'integer',
    ];

    public function workPlan(): BelongsTo
    {
        return $this->belongsTo(WorkPlan::class);
    }
}
