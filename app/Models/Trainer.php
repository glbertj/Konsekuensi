<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['inisial','jabatan','uuid','updated_at'];
    protected $primaryKey = 'uuid';

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
