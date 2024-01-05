<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = ['kode_trainee', 'status', 'contact', 'alamat', 'tanggal_lahir', 'image', 'accountid','uuid'];
    protected $primaryKey = 'uuid';
    protected $table = 'trainees';
    protected $casts = [
        'uuid' => 'string'
    ];

    public function calculateTotalScore($leaderboard)
    {
        $totalScore = 0;

        foreach ($leaderboard as $task) {
            if ($task->trainee_uuid == $this->uuid && $task->status == true) {
                $totalScore += $task->score;
            }
        }

        return $totalScore;
    }
    
    public function users()
    {
        return $this->belongsTo(Users::class,'uuid');
    }

    public function projectUsers()
    {
        return $this->hasMany(Project_Users::class, 'user_id');
    }
}
