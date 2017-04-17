<?php

namespace App\Console\Commands\Board;

use App\Http\Controllers\Lib\Board\Module\LocatorModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class PreferenceCache extends Command
{
    public $preference;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:preference';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LocatorModule $preference)
    {
        parent::__construct();
        $this->preference = $preference;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->deleteKeys();
        $this->preference->getArticle();
        $this->preference->getEmplacement();
    }

    private function deleteKeys()
    {
        $keys = [
            'board.preference.articles',
            'board.preference.emplacement',
        ];

        foreach ($keys as $key)
        {
            $inc = Redis::get($key);
            if ($inc <> null ) Redis::del($key);
        }

    }
}
