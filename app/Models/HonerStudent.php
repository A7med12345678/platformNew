<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HonerStudent extends Model
{
    protected $fillable = ['image','image_for','exam_id'];
    use HasFactory;
//     protected $casts = [
//     'images' => 'array',
// ];

}
