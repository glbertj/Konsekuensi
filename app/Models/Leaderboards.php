<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboards extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','totalscore'];

    public function entries()
    {
        return $this->hasMany(Leaderboard_Project::class);
    }
}
