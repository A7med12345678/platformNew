<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_code',
        'course',
        'status',
        'approver_code',
        'comment',
        'name',
        'email',
        'phone',
        'request_code'
    ];

    public function user_details()
    {
        return $this->belongsTo(User::class, 'student_code', 'center_code');
    }


}
