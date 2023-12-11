<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class homework extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'user_id',
        'user_name',
        'user_grade',
        'week1sec3h',
        'week2sec3h',
        'week3sec3h',
        'week4sec3h',
        'week5sec3h',
        'week6sec3h',
        'week7sec3h',
        'week8sec3h',
        'week9sec3h',
        'week10sec3h',
        'week11sec3h',
        'week12sec3h',
        'week13sec3h',
        'week14sec3h',
        'week15sec3h',
        'week16sec3h',
        'week17sec3h',
        'week18sec3h',
        'week19sec3h',
        'week20sec3h',
        'week21sec3h',
        'week22sec3h',
        'week23sec3h',
        'week24sec3h',
        'week25sec3h',
        'week26sec3h',
        'week27sec3h',
        'week28sec3h',
        'week29sec3h',
        'week30sec3h',
        'week31sec3h',
        'week32sec3h',
        'week33sec3h',
        'week34sec3h',
        'week35sec3h',
        'week36sec3h',
        'week37sec3h',
        'week38sec3h',
        'week39sec3h',
        'week40sec3h',
        'week41sec3h',
        'week42sec3h',
        'week43sec3h',
        'week44sec3h',
        'week45sec3h', 
    
    ];
    protected $dates = ['deleted_at'];

}
