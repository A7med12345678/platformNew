<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminChat extends Model
{
    use HasFactory;

    protected $table = 'adminschat';

    protected $fillable = [
        'sender_id',
        'sender_name',
        'content',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
