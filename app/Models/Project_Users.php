<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Users extends Model
{
    use HasFactory;



    protected $table = 'project_user';
    protected $fillable = ['project_id', 'user_id', 'list_id', 'status','updated_at','created_at'];
    protected $primaryKey = ['user_id','project_id'];
    public $incrementing = false;
    protected $casts = [
        'uuid' => 'string'
    ];

    public function project()
    {
        return $this->belongsTo(Project_Table::class, 'project_id');
    }

    public function list()
    {
        return $this->belongsTo(List_Table::class, 'list_id');
    }

    public function user()
    {
        return $this->belongsTo(Trainee::class, 'user_id', 'uuid');
    }
}
