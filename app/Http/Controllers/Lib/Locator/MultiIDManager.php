<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 05/04/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Lib\Locator;


use App\Stock;

class MultiIDManager
{
    public $request;
    public $pointPosition;
    public $id;
    public $arg;
    public $error;
    public $id_;


    public function setRequest($request)
    {
        $this->request = strtoupper(deleteSpaceStartAndEnd($request->input('multi'))) ;
        return $this;
    }

    public function validateInput()
    {
        $this->error = FALSE;
        if( $this->request == null ) $this->error = TRUE ;
        if( $this->request == '' ) $this->error = TRUE ;
        if($this->error == false)
        {
            $this->id = $this->getID();
            $this->arg = $this->getArg();
            $this->error = $this->arg == 0 ? TRUE : FALSE;
            $this->error =  ! is_numeric($this->id) ? TRUE : FALSE;
        }

        return $this->error;
    }

    public function searchArrayID()
    {
        $this->id_ = [];
        $this->id_[] =intval($this->id );

        for($i=1 ; $i < $this->arg ; $i++)
        {
            $this->id_[]=$this->id+$i;
        }

        return $this;
    }

    public function flash()
    {
        session()->forget('errorMulti');
        session()->flash('dataMultiple',$this->id_);
    }

    /**
     * ARRAY EN INPUT
     * @param null $id
     * @return mixed
     */
    public function searchID($id = null)
    {
        if($id == null)
        {
            return Stock::whereIn('id_locator',$this->id_)->with('articleModel')->get();
        }
        return Stock::whereIn('id_locator',$id)->with('articleModel')->get();
    }

    /**
     * @return string
     */
    private function getID()
    {
        $prefix = substr($this->request,0,2) == 'ID' ? true : false;
        $this->request =  $prefix == true ? substr( $this->request,2) :  $this->request ;
        $this->pointPosition = strpos($this->request, '.');
        $id = $this->pointPosition == false ? $this->request : substr($this->request, 0, $this->pointPosition);

        return $id;
    }

    /**
     * @return int|string
     */
    private function getArg()
    {
        $arg = $this->pointPosition == false ? 1 : intval(substr($this->request, $this->pointPosition + 1, strlen($this->request)));
        return $arg;
    }
}