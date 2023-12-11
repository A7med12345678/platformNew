<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class select extends Model
{
    protected $table = 'selected_divs';
    protected $fillable = ['selected_week', 'selected_section' , 'homework'];

    use HasFactory;
}
