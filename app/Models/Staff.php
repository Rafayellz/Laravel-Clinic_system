<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\bookings;
use App\Models\Inventory;

class Staff extends Model
{
    protected $table = 'staff';

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
        return $this->hasMany(Bookings::class, 'staff_id');
    }

    // public function inventory()
    // {
    //     return $this->hasMany(Inventory::class, 'staff_id');
    // }
}
