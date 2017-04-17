<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 07/02/2017
 * Time: 21:48
 */

namespace App\Console\Commands\Board;


use App\Http\Controllers\Lib\Board\Module\ArriveModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ArriveCache extends Command
{
    public $arrive;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:arrive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cache arrive';

    /**
     * ArriveCache constructor.
     */
    public function __construct(ArriveModule $arrive)
    {
        parent::__construct();
        $this->arrive = $arrive;
    }

    public function handle()
    {
        $this->deleteGenericKeys();
        $this->arrive->logic();
    }

    private function deleteGenericKeys()
    {
        $inc = Redis::keys('*arrive.last*');
        if ($inc) Redis::del($inc);
    }


}