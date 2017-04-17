<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PDF</title>
<link rel="stylesheet" href="/lab/resources/assets/css/application.css"  media="all"  />
    <style>

        body{

        font: Helvetica;
        }
        .page-break{page-break-after  :  always;}

        ul.c {
         font-size: 12px;
        list-style-type: square;
        }
        li.UlNone{
            list-style-type: none;
          }
        hr{
            height: 0;
            border-right: 0;
            border-top: 0;
            border-bottom: 1px solid #cacaca;
            border-left: 0;
            margin: 10px auto;
            Margin: 10px auto;
            clear: both;
        }
	</style>

</head>

<body>
    <h3 class="googleB">Resumé horaire</h3>
    <hr/>
    <?php $i=1; ?>

   @foreach($r as $kr => $vr)

        {{$i++}} - {{$u[$kr]->USER_nom}}  {{$u[$kr]->USER_prenom}} ( {{$u[$kr]->USER_postefixe}} )<br/>

        @foreach($vr as $kse => $vse)
            <ul class="c">
                <li>
                    Solde du <b>{{$kse}}</b> <br/>
                    Récupèration:
                        @if($vse->CUMULE_rec_solde == 0)  @else <b>{{$hg->mh($vse->CUMULE_rec_solde)}}h</b> @endif/
                    Heures-Payées:
                        @if($vse->CUMULE_hp_solde == 0)  @else <b>{{$hg->mh($vse->CUMULE_hp_solde)}}h</b>  @endif/
                    Heures-NON-payées:
                        @if($vse->CUMULE_hnp_solde == 0)  @else <b>{{$hg->mh($vse->CUMULE_hnp_solde)}}h</b> @endif/
                    Congès Payés:
                        @if($vse->CUMULE_cp_solde == 0) - @else <b>{{$vse->CUMULE_cp_solde}}</b>   @endif/
                    Enfant malade:
                        @if($vse->CUMULE_ef_solde == 0)  @else <b>{{$vse->CUMULE_ef_solde}}</b> @endif
                    <br/>
                     <br/>
                </li>
 <br/>
                    @foreach($ints[$kse][$u[$kr]->USER_id] as $khu => $vsu)
                        @if( $vsu->recup <> 0 OR $vsu->heure_paye <> 0 OR $vsu->cp <> 0 OR $vsu->cp2 <> 0 OR $vsu->ef <> 0 OR $vsu->hnp <> 0 )
                            <li class="UlNone">
                            Le {{$vsu->date_r}} - heures travaillées : {{$vsu->heures_taff}} - commentaires : {{$vsu->com}}
                            </li>
                        @endif
                    @endforeach
            </ul>
        @endforeach


   @if( $i == 3 OR   $i == 5 OR   $i == 7 OR  $i == 9 OR  $i == 11 OR  $i == 13 OR  $i == 15  OR  $i == 17 OR  $i == 19 OR  $i == 21  OR  $i == 23OR  $i == 25  ) <div class="page-break"></div> @endif
   <br/>
   @endforeach



</body>
</html>