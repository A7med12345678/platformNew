<?php

namespace App\Jobs;

use App\Models\specialLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SpecialLoginJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $senderId;
    protected $senderName;
    protected $logType;
    protected $content;

    public function __construct($senderId, $senderName, $logType, $content)
    {
        $this->senderId = $senderId;
        $this->senderName = $senderName;
        $this->logType = $logType;
        $this->content = $content;
    }

    public function handle()
    {
        specialLog::create([
            'sender_id' => $this->senderId,
            'sender_name' => $this->senderName,
            'log_type' => $this->logType,
            'content' => $this->content,
        ]);
    }
}
