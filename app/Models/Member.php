<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'nrp',
        'phone',
        'bike_type',
        'bike_year',
        'bike_color',
        'photo',
        'join_date',
        'status',
        'address',
        'notes'
    ];

    protected $casts = [
        'join_date' => 'date'
    ];

    /**
     * Get the member's photo URL with default fallback
     * Returns default 3x4 cm photo if no photo is uploaded
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo && file_exists(public_path($this->photo))) {
            return asset($this->photo);
        }
        
        return asset('images/default-member.svg');
    }
}
