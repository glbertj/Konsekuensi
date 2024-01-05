<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Table extends Model
{
    use HasFactory;

    protected $table = 'project__tables';
    protected $fillable = ['title', 'started_date', 'end_date'];

    public function lists()
    {
        return $this->hasMany(List_Table::class, 'project_id');
    }

    public function projectUsers()
    {
        return $this->hasMany(Project_Users::class, 'project_id');
    }
}
