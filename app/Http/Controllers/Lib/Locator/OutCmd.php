<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 04/04/2017
 * Time: 13:03
 */

namespace App\Http\Controllers\Lib\Locator;


use App\Stock;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class OutCmd
{

    public $cmd;
    public $error;
    public $request;

    /**
     * OutCmd constructor.
     */
    public function __construct()
    {
        $this->error = FALSE;
    }

    public function setCmd($cmd)
    {
        $this->cmd = $cmd;

        return $this;
    }

    public function validformatOut()
    {
        $status = FALSE;

        if( $this->cmd <> '' )
        {
            $status = $this->validate();
        }
        return $status;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        $this->setCmd($this->request->cmd);

        return $this;
    }

    public function out()
    {
        try
        {
            $this->id = Stock::findOrFail($this->request->id);
            $this->getOut();
        }
        catch (ModelNotFoundException $ex)
        {
            return view('errors.503') ;
        }
    }

     function flashMsg()
    {
        if($this->isEmpty() == false)
        {
            if( $this->isNotNum() == false) $this->isToShort();
        }
    }

    private function isEmpty()
    {
        if( ($this->cmd == '' ) and ($this->cmd <> 'mjstk' ))
        {
            session()->flash('empty_cmd','Le numero de commande est vide');
            return TRUE;
        }
        return FALSE;
    }

    private function isNotNum()
    {
        if(  ! is_numeric($this->cmd))
        {
            session()->flash('not_num','Numéro de commande n\'est pas au bon format : 3172521');
            return TRUE;
        }
            return FALSE;
    }

    private function isToShort()
    {
        if(  ! strlen($this->cmd))
        {
            session()->flash('too_short','Numéro de commande n\'est pas au bon format');
            return TRUE;
        }
        return FALSE;
    }

    private function getOut()
    {
        $this->id->out_datetime = carbon::now()->toDateTimeString();
        $this->id->out_id_user = Auth::id();
        $this->id->out_id_cmd = $this->request->cmd;
        $this->id->save();
    }

    public function multipleGetOut()
    {
        Stock::whereIn('id_locator',session()->get('dataMultiple'))
            ->update([
                'out_datetime' => carbon::now()->toDateTimeString() ,
                'out_id_user' => Auth::id() ,
                'out_id_cmd' => $this->request->cmd,
            ])
        ;
    }

    private function validate()
    {
        if ($this->cmd == 'mjstk' )
            return TRUE;

        if(is_numeric($this->cmd) AND strlen($this->cmd) == 7)
            return TRUE;

        return FALSE;
    }

    public function selectOut($arg = null)
    {
        $dt = Carbon::now();
        $dt->subMonths(3);

        $ids = Stock::whereNotNull('out_datetime')
            ->where('out_datetime','>',$dt->toDateTimeString())
            ->with('articleModel')
            ->orderBy('out_datetime','DESC')
            ;

        if($arg == 'paginate') $ids = $ids->paginate(20);
        if($arg == null) $ids = $ids->get();

        return $ids;
    }

}