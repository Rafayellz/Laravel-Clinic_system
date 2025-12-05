<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
   /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

     protected $table = 'patient';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'first_name', 
        'last_name',
        'id_number',
        'phone_number', 
        'institute',
        'gender',
        'height',
        'weight',
        'date_of_birth',
        'address', 
        'emergency_cont', 
        'email', 
        'role',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // get full name attribute
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // get age attribute
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            return \Carbon\Carbon::parse($this->date_of_birth)->age;
        }
        return null;
    }
}
