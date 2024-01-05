<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;

    //    TODO: Add Needed Syntax
    use HasUuids;
    use Authenticatable;

    protected $fillable = ['email', 'password', 'role','jurusan','binusian','nama_lengkap'];
    protected $primaryKey = 'id';
    public $timestamps = false;

//    TODO: Eloquent Relationship


    public function trainee()
    {
        return $this->hasOne(Trainee::class,'uuid');
    }

    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }


}


