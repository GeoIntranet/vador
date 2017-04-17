<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 17/08/2016
 * Time: 15:31
 */

namespace App\Http\Controllers\Lib\Locator;


use App\Http\Controllers\Controller;

class LocatorConfiguration extends Controller
{
    const DEFF = 0 ;
    const THERMIQUE = 1;
    const MATRICIEL = 2;
    const PISTOLET = 3;
    const LASER = 4;
    const AS400  = 5;
    const MICRO = 6;
    const JET = 7;
    const SUB = 8;
    const NA = 9;
    const NEUF = 10;
    const OCCASE = 11;
    const RECON = 12;
    const HS = 13;

    public $preferences ;
    public $cache;
    public $inputs;

    /**
     * 3 parametres , le cache , les inputs , et les preferences , utilisable par LocatorGenerator.
     * LocatorConfiguration constructor.
     * @param $preferences
     */
    public function __construct()
    {
        $this->preferences = [];
        $this->cache = [];
        $this->input = [];
    }

    /**
     * regarde si cache stocker en CACHE
     * @return bool
     */
    public function haveCache()
    {
        return FALSE;
    }

    /**
     * regarde si inputs
     * @return bool
     */
    public function haveInputs()
    {
        return FALSE;
    }

    /**
     * retourne cache formater || HOMOGENE AVEC getInputs
     * @return mixed
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * retourne input formater || HOMOGENE AVEC getCache
     * @return mixed
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * Recupere le cache si presence et le formate  || comparaison homogène avec inputs
     */
    public function setCache()
    {
        if($this->haveCache()){
            $this->cache = FALSE;
        }
    }

    /**
     * Recupere les input si presence et le formate || comparaison homogène avec cache
     * @param $inputs
     */
    public function setInputs($inputs)
    {
        if($this->haveInputs()){
            $this->inputs = FALSE;
        }
    }

    /**
     * 1 . presence cache?
     * 2 . presence inputs ?
     * 3 . si rien dans les deux affichage par defaut , preferences == DEFAULT
     * 4 . si presence cache, presence input obligatoire , si cache  == inputs , aucune modif user , il veut affichage preference cache
     * 5 . si cache <> inputs , user veut changer les preferences
     * @param $inputs
     */
    public function setPreferences($inputs)
    {
        $this->setCache();
        $this->setInputs($inputs);

        $this->preferences = $this->haveCache() == TRUE ? $this->getCache() : [];
        $this->preferences = $this->getCache() <> $this->getInputs() ? $this->getInputs() : $this->getCache();

        $this->saveConfig();
    }

    /**
     *  1 . test si presence case se souvenir cocher
     *  2 . si cocher , on met en cache , sinon on flush
     */
    public function saveConfig()
    {
        $this->needToSave() ? $this->save() : $this->flush() ;
    }

    /**
     * Test si config a besoin d'etre rentrer en cache
     * @return bool
     */
    public function needToSave()
    {
        return  $this->inputs == TRUE ? TRUE : FALSE ;
    }

    /**
     * 1 . Test si presence cache
     * 2 . Remplacement cache existant par nouvell.
     * 3 . save
     */
    public function save()
    {

    }

    /**
     * on flush le cache des preference user
     */
    public function flush()
    {

    }
}