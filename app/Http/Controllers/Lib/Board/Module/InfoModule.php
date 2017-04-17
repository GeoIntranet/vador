<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 02/02/2017
 * Time: 18:45
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\Commande;
use App\Incident;
use App\Information;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class InfoModule extends Module
{
    public $info;
    public $stock;
    public $commande;
    public $incident;
    public $dt;

    /**
     * InfoModule constructor.
     */
    public function __construct(
        Information $information,
        Stock $stock,
        Commande $commande,
        Incident $incident
    )
    {
        parent::__construct(App('Illuminate\Support\Facades\Redis'));

        $this->info = $information;
        $this->stock = $stock;
        $this->commande = $commande;
        $this->incident = $incident;
        $this->dt = Carbon::now();
        $this->anniversaireUser= [];
        $this->data= [];
    }

    public function handle()
    {

        $this->logic();

        return $this->data;
    }

    private function logic()
    {
        $this->birthdayLogic();
        $audit = $this->auditLogic();
        $incidentOuvert = $this->incidentLogic();
        $Absent = $this->absenceLogic();


        $vendredi = FALSE;
        $DtCopy = $this->dt->copy();

        if( $this->dt->dayOfWeek == 1 ) { $DtCopy->subDays(3); $vendredi = TRUE;}
        elseif($this->dt->dayOfWeek == 7){ $DtCopy->subDays(2); $vendredi = TRUE;}
        else{ $DtCopy->subDay(1); }

        $expedition = $this->commandSent($DtCopy);

        $enCours = $this->commandeLogic();

         $this->data=
            [
                'anniv' => $this->anniversaireUser,
                'V' => $vendredi,
                'audit' => $audit,
                'incidentO' => $incidentOuvert,
                'ABS' => $Absent,
                'exp' => $expedition,
                'enc' => $enCours
            ];
    }

    private function birthdayLogic()
    {
        $dtAnniversair = $this->dt->copy()->format('m-d');
        $anniversaire = $this->getBirthdayUser();

        foreach ($anniversaire as $k => $v) {
            $dtAnn = substr($v->USER_datenais, 5, 5);

            if ($dtAnniversair == $dtAnn) {
                $this->anniversaireUser = [
                    'nom' => $v->USER_nom,
                    'prenom' => $v->USER_prenom,
                ];
            }
        }
    }

    /**
     * @return mixed
     */
    public function getBirthdayUser()
    {
        $key = 'birthday.users';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->info->dtAnniversaire();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function auditLogic()
    {
        $key = 'locator.audit.counter';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->stock->ToAudit()->count();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public function incidentLogic()
    {
        $key = 'incident.all.actif';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->incident->actif()->count();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public function absenceLogic()
    {
        $key = 'absence';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->info->Absent();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public function commandeLogic()
    {
        $key = 'commande.encour';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->commande->enCours()->count();;
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }
        return $data;
    }

    /**
     * @param $DtCopy
     * @return mixed
     */
    public function commandSent($DtCopy)
    {
        $key = 'commande.sent.'.$DtCopy->format('Y-m-d');
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->commande->CountSent($DtCopy->format('Y-m-d'))->count();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }
        return $data;
    }

}