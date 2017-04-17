<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 01/04/2017
 * Time: 17:01
 */

namespace App\Http\Controllers\Lib\Locator;


use App\Http\Controllers\Lib\Id\IdManager;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class repositoryLocatorManager
{


    /**
     * repositoryManager constructor.
     */
    public function __construct(IdManager $locator)
    {
        $this->locator = $locator;
        $this->errors = [];
    }

    public function init($request)
    {
        $this->input = $request->all();
        return $this;
    }

    /**
     *
     */
    public function update()
    {
        if($this->isExist())
        {

            $this->locator->init($this->id);

            $this
                ->state()
                ->statutHS()
                ->description()
                ->article()
                ->serialNumber()
                ->locator()
            ;
            $this->id->save();
        }
    }

    public function isExist()
    {
        $this->id = Stock::find($this->input['id']);

        return $this->id <> null ? TRUE : FALSE;
    }

    private function statutHS()
    {
        $this->id->hs = isset($this->input['hs']) ? $this->input['hs'] : 0 ;
        return $this;
    }

    private function description()
    {


        $description = nl2brplus($this->input['description']);

        $this->id->description = $description;
        return $this;
    }

    private function serialNumber()
    {
        $this->id->num_serie = $this->input['num_serie'];
        return $this;
    }

    private function state()
    {

        if( ! $this->locator->isAudit)  $this->makeAudit();

        if($this->input['etat'] == 0) $this->unAudit();

        $this->id->id_etat = $this->input['etat'];

        return $this;
    }

    private function locator()
    {
        $this->id->locator = $this->input['locator'];
        return $this;
    }

    private function makeAudit()
    {
        $this->id->aud_datetime = carbon::now()->toDateTimeString();
        $this->id->aud_id_user = Auth::id();
    }

    private function unAudit()
    {
        $this->id->aud_datetime = null;
        $this->id->aud_id_user = null;
        $this->id->hs = null;
    }

    private function article()
    {
       $art = isset($this->input['art_list']) ? $this->input['art_list'] : $this->input['art_perma'];
        $this->id->article = $art;

        return $this;
    }
}