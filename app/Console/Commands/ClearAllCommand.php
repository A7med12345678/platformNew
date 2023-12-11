<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCommand extends Command
{
    protected $signature = 'clearall';

    protected $description = 'Clear all caches and optimizations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->call('optimize');
        $this->call('view:cache');
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('route:cache');
        $this->call('config:clear');
        $this->call('config:cache');

        $this->info('All caches and optimizations cleared.');
    }
}
