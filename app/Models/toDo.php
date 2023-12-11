<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toDo extends Model
{
    use HasFactory;

    protected $table = 'todo';
    protected $fillable = [
        'content',
        'sender_id',
    ];
}