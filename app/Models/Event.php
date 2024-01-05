<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'events';
    protected $primaryKey = 'id';

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
        // 'due' => 'datetime'
    ];
}
