<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'type',
        'max_participants',
        'contact_person',
        'contact_phone',
        'requirements',
        'fee',
        'image',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'fee' => 'decimal:2',
        'max_participants' => 'integer'
    ];

    public function documentations()
    {
        return $this->hasMany(Documentation::class);
    }
}
