<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'date',
        'image',
        'video_url',
        'event_id',
        'views',
        'status',
        'photographer',
        'tags'
    ];

    protected $casts = [
        'date' => 'date',
        'views' => 'integer'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
