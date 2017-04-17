<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 23/01/2017
 * Time: 22:11
 */

namespace App\Http\Controllers\Lib\Delais;


use App\Delais;

class DelaisManager
{
    public $in;
    public $tasks;
    public $delais;
    public $delai;

    /**
     * DelaisManager constructor.
     */
    public function __construct(Delais $delai)
    {
        $this->delai = $delai;

        $this->tasks=[
            'search',
            'extracted',
            'render',
            'index',
        ];

    }

    public function setBl($bl)
    {
        $this->in = $bl;
        return $this;
    }

    public function handle()
    {
        foreach ($this->tasks as $index => $task)
        {
                $this->$task();
        }

        $this->clean();

        return $this->delais;
    }

    public function search()
    {
        $this->delais =
            $this->in <> null ?
                $this->delai->SearchDelaisIn($this->in) : $this->delai->SearchDelaisIn($this->in);

        return $this;
    }

    public function extracted()
    {
        $this->bl = $this->delais->pluck('id_cmd');

        return $this;
    }

    public function render()
    {
        $this->delais = $this->delais->toArray();
    }

    public function index()
    {
        $tmp=[];

        foreach ($this->delais as $index => $delai)
            $tmp[$delai['id_cmd']]=$delai;

        $this->delais=[];
        $this->delais = $tmp;

        return $tmp;
    }
    public function clean()
    {
        unset($this->in);
        unset($this->tasks);
        unset($this->delai);
    }
}