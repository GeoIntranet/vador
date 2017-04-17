<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 26/01/2017
 * Time: 22:42
 */

namespace App\Http\ViewComposer;
use App\Http\Controllers\Lib\Gestion;
use Illuminate\View\View;
use Carbon\Carbon;

class DelaisComposer extends Gestion
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view
            -> with('user',$this->getUsers())
            -> with('categorie',$this->getCategorieGlobal())
            -> with('now',Carbon::now())
        ;
    }
}