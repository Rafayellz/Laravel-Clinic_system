<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bookings;
use App\Models\Diagnoses;
use App\Models\PrescriptionItem;
class Doctor extends Model
{
     protected $table = 'doctors';

    protected $fillable = [
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'doctor_id');
    }

    // public function diagnoses()
    // {
    //     return $this->hasMany(Diagnoses::class, 'doctor_id');
    // }

    // public function prescriptions()
    // {
    //     return $this->hasMany(PrescriptionItem::class, 'doctor_id');
    // }
}
