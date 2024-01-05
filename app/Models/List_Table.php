<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_Table extends Model
{
    use HasFactory;

    protected $table = 'list__tables';
    protected $fillable = ['project_id', 'desc','list', 'score'];

    public function project()
    {
        return $this->belongsTo(Project_Table::class, 'project_id');
    }

    public function projectUsers()
    {
        return $this->hasMany(Project_Users::class, 'list_id');
    }


}
