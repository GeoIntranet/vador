<?php

namespace App\Console\Commands\Board;

use App\Http\Controllers\Lib\Board\Module\FavModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FavorisCache extends Command
{
    public $users;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:favoris';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var FavModule
     */
    private $favorite;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FavModule $favorite)
    {
        parent::__construct();

        $this->favorite = $favorite;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->users=[48];

        foreach ($this->users as $index => $user)
        {
            $this->deleteKey($user);
            $this->favorite->setUser($user);
            $this->favorite->search();
        }
    }

    private function deleteKey($id)
    {
        $keys = [
            'board.link.'.$id
        ];

        foreach ($keys as $key) {
            $inc = Redis::get($key);
            if ($inc <> null) Redis::del($key);
        }
    }
}
