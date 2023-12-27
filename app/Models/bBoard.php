<?php
//bBoard.php merupakan model eloquent dari dari bBoard tabel
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bBoard extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];
}
