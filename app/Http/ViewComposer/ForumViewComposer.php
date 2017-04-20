<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 09/04/2017
 * Time: 17:52
 */

namespace App\Http\ViewComposer;


use App\Channel;
use Illuminate\View\View;
class ForumViewComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view )
    {
        $channels  = Channel::OrderBy('name','ASC')->get();
        $color = 'blue';

        $view
            -> with('channels',$channels)
            -> with('admin',48)
            -> with('color',$color)
        ;
    }
}