<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 22/03/2016
 * Time: 08:37
 */

namespace App\Http\Controllers\Lib;

use App\Http\Controllers\Controller;
use DB ;
use Auth;
use App\User as User;

class MenuGestion extends Controller{

    public $user;
    public $userGestion;

    function __construct(){ }

    /**Initialisation de l'utilisateur connecter
     * @param $user
     */
    public function initAuth($user){
        $this->user = $iUser = Auth::user();
    }

    /**Getter de l'utilisateur connecter
     * @return mixed
     */
    public function GetUserAuth(){
        return $this->user;
    }

    /**retourne l'avatar de l'utilisateur enregistrer
     * @return mixed
     */
    public function userIcone() {
        return $this->user->USER_icone;
    }

    public function isAdmin(){
        return ($this->user->USER_type >= 5) ? TRUE : FALSE;
    }



} 