<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instruction extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id' , 'grade', 'content'];

}
