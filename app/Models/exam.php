<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exam';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_grade',
        'week1sec4',
        'week2sec4',
        'week3sec4',
        'week4sec4',
        'week5sec4',
        'week6sec4',
        'week7sec4',
        'week8sec4',
        'week9sec4',
        'week10sec4',
        'week11sec4',
        'week12sec4',
        'week13sec4',
        'week14sec4',
        'week15sec4',
        'week16sec4',
        'week17sec4',
        'week18sec4',
        'week19sec4',
        'week20sec4',
        'week21sec4',
        'week22sec4',
        'week23sec4',
        'week24sec4',
        'week25sec4',
        'week26sec4',
        'week27sec4',
        'week28sec4',
        'week29sec4',
        'week30sec4',
        'week31sec4',
        'week32sec4',
        'week33sec4',
        'week34sec4',
        'week35sec4',
        'week36sec4',
        'week37sec4',
        'week38sec4',
        'week39sec4',
        'week40sec4',
        'week41sec4',
        'week42sec4',
        'week43sec4',
        'week44sec4',
        'week45sec4',
    ];
    protected $dates = ['deleted_at'];

}
