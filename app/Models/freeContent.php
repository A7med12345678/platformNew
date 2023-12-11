<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freeContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'urlfreeContent',
        'grade',
    ];
}