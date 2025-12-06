<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'stock',
        'expiry_date',
        'description'

    ];

    protected $cast = [
        'expiry_date' => 'date',
    ];

    //Check if medicine is expired
    public function isExpired() 
    {
        return $this->expiry_date < Carbon::today();
    }

    //Check if stock is low
    public function isLowStock()
    {
        return $this->stock < 50 && $this->stock > 0;
    }

    //Get Status Badge
    public function getStatusAttribute() 
    {
        if($this->isExpired()) {
            return 'expired';
        } else if ($this->isLowStock()){
            return 'low';
        } else {
            return 'normal';
        }
    }

    //Get status badge class
    public function getStatusBadgeAttribute()
    {
        return match($this->status){
            'expired' => 'badge-expired',
            'low' => 'badge-low',
            default => 'badge-normal',
        };
    }

    //Get status text
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'expired' => 'Expired',
            'low' => 'Low Stock',
            default => 'Normal'
        };
    }

    
}
