<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialLog extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'sender_name', 'content', 'log_type'];

}