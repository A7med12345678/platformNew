<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timeTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'for_course',
        'lecture_day',
        'lecture_time',
        'lecture_time_end',
        'exam_day',
        'exam_time',
        'exam_time_end'
    ];
}
