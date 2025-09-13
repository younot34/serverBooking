<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'room_name',
        'date',
        'time',
        'duration',
        'number_of_people',
        'equipment',
        'host_name',
        'meeting_title',
        'is_scan_enabled',
        'scan_info',
        'status',
        'location',
    ];

    protected $casts = [
        'equipment' => 'array',
        'is_scan_enabled' => 'boolean',
    ];
}

