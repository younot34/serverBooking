<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name', 'room_name', 'location', 'install_date',
        'capacity', 'equipment', 'is_on'
    ];

    protected $casts = [
        'install_date' => 'date',
        'equipment' => 'array',
        'is_on' => 'boolean',
    ];
}
