<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection ="eurocomputer";
    protected $table ='po';



    public function scopeSearchPoInformation($query , $list)
    {

        return $query
            ->select(
                'po.po_id',
                'po.po_dt_prev_arr',
                'po_societe.pos_id',
                'po_societe.pos_nom'
            )
            ->join('po_societe', 'po.po_pos_id', '=', 'po_societe.pos_id')
            ->whereIn('po_id',$list)
            ->get()
            ;
    }
}
