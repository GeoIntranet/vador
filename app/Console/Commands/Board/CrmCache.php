<?php

namespace App\Console\Commands\Board;

use App\Http\Controllers\Lib\Board\Module\CrmModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class CrmCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:crm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var CrmModule
     */
    private $crm;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CrmModule $crm)
    {
        parent::__construct();
        $this->crm = $crm;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->deleteKeys();
        $this->crm->last();
    }

    private function deleteKeys()
    {
        $keys = [
            'board.crm.action.last'
        ];

        foreach ($keys as $key) {
            $inc = Redis::get($key);
            if ($inc <> null) Redis::del($key);
        }
    }
}
