<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
     protected $fillable = [
        'user_id',
        'appointment_date',
        'appointment_time',
        'doctor',
        'service_type',
        'reason',
        'status'
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    /**
     * Get the user that made the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Convert time and service to a more readable format
    public function getServiceNameAttribute()
    {
        $services = [
            'general' => 'Medical Checkup',
            'dental' => 'Health Concern'
        ];
        return $services[$this->service_type] ?? ucfirst($this->service_type);
    }

    public function getFormattedTimeAttribute()
    {
        return \Carbon\Carbon::createFromFormat('H:i', $this->appointment_time)->format('g:i A');
    }
}
