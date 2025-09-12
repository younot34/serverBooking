<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id', 'room_name', 'date', 'time', 'duration',
        'number_of_people', 'equipment', 'host_name',
        'meeting_title', 'is_scan_enabled', 'scan_info',
        'status', 'location'
    ];

    protected $casts = [
        'date' => 'date',
        'equipment' => 'array',
        'is_scan_enabled' => 'boolean',
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}

