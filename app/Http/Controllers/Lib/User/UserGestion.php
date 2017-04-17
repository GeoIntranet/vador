<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 11/09/2016
 * Time: 15:46
 */

namespace App\Http\Controllers\Lib\User;

use App\TemplateRight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserGestion
{

    public $info;
    public $id;
    public $template;

    /**
     * UserGestion constructor.
     */
    public function __construct()
    {
        $this->info = Auth::user() ;
        $this->id = $this->info->id;
    }



    /**
     * nous retourne la liste de ou des utilisateur sur lequelle on pourra appliquer nos methodes
     * @return array
     */
    public function getUsers()
    {
        return $this->user;
    }

    /**
     * Permet d'initialiser notre variable afin de pouvoir utiliser nos methodes dessus.
     * @param array $users
     */
    public function setUsers($users)
    {
        $this->user = $users;
    }
    
    /**
     * Verifie si un utilisateur est administrateur
     */
    public function isAdmin()
    {
    }

    /**
     * Verifie si l'utilisateur authentifie est administrateur
     * @return bool
     */
    public function authIsAdmin()
    {
        return Auth::user()->USER_type >= 6 ? TRUE : FALSE ;
    }

    /**
     * Verifie si un Utilisateur existe
     */
    public function isExist()
    {
    }

    /**
     * Verifie si un utilisateur estactif
     */
    public function isActive()
    {
    }

    /**
     * Nous donne les droit de l'utilisateur
     */
    public function rightUser()
    {
    }
}