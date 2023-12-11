<?php

namespace App\Services;

use App\Models\specialLog;
use Illuminate\Support\Facades\Auth;

class SpecialLogService
{
    public static function createLog($logType, $content, $id = null, $name = null)
    {
        $senderId = $id ?? Auth::user()->id ?? '';
        $senderName = $name ?? Auth::user()->name ?? '';

        specialLog::create([
            'sender_id' => $senderId,
            'sender_name' => $senderName,
            'log_type' => $logType,
            'content' => $content,
        ]);
    }

}
