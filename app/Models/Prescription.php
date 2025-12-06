<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_name',
        'appointment_id',
        'medicine_id',
        'quantity',
        'notes',
        'given_by'
    ];

     // Relationship with Medicine
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    // Relationship with User (Staff who gave medicine)
    public function givenBy()
    {
        return $this->belongsTo(User::class, 'given_by');
    }
}
