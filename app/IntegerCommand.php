<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class IntegerCommand extends Model
{

    protected $table = 'integer_command';
    protected $dates=[
        'date',
    ];
    protected $relations ;
    public $timestamps = false;
    protected $fillable = [
        'date',
        'bl',
        'commande_ligne',
        'client',
        'cp',
        'id_user',
        'qt_c',
        'qt_l',
        'qt_f',
        'code_as',
        'designation',
        'description',
        'option',
        'export_fr',
        'garantie',
        'prix_unit',
        'total',
        'prestation',
        'facture',
        'therm',
        'pisto',
        'micro',
        'las',
        'mat',
        'as',
        'jet',
        'repair'
    ];

    /**
     *
     */
    public function __construct()
    { }

    public function scopeLastDayIntegrate($query)
    {
        return $query
            ->select('date')
            ->orderBy('date','DESC')
            ->limit(1)
            ->take(1)
            ->first()
            ;
    }

    /**
     * check si un bl est integrer
     * @param $query
     * @param $command
     * @return mixed
     */
    public function scopeIsIntegrate($query , $command)
    {
        return $query
            ->select('date')
            ->where('bl',$command)
            ->count();
    }

    /**
     * check si un tableau de bl est integrer
     * @param $query
     * @param $arrayCommand
     * @return mixed
     */
    public function scopeCheckIntegrate($query, $arrayCommand, $date)
    {

        return $query
            ->select('bl')
            ->where('date_livr',$date)
            ->whereIn('bl',$arrayCommand)
            ;
    }

    /**
     * check si un tableau de bl est integrer
     * @param $query
     * @param $arrayCommand
     * @return mixed
     */
    public function scopeCheckDate($query, $date)
    {
        return $query->where('date',$date);
    }
}
