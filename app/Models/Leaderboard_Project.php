<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard_Project extends Model
{
    use HasFactory;

    protected $fillable = ['leaderboard_id', 'list_id', 'trainee_id', 'score','created_at','updated_at'];

    public function leaderboard()
    {
        return $this->belongsTo(Leaderboards::class);
    }
}
