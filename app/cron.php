<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cron extends Model
{
    public  $table = 'crons';
    public $fillable = [
      'CRON_name',
      'CRON_job',
    ];
}
