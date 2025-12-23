<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerInquiry extends Model
{
    protected $fillable = [
        'organization_name',
        'contact_person',
        'email',
        'phone',
        'partnership_interest',
        'partnership_type',
        'message',
        'status',
    ];
}
