<?php

namespace App\Src\Frontend\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public $table = 'students';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'email',
    ];
}
