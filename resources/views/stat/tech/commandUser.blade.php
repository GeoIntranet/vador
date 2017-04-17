
@extends('templateModule')


@section('t')
    Statistique utilisateur
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('content')
    <br/>
    {{--CONTAINER------------------------------------------------------------------------------------------------------------------------------}}
    <div class="row incidentContainer pad5">

        {{--PARTI 1 MENU + ENTETE---------------------------------------------------------------------------------------------------------------}}
        <div class="medium-2 large-2  column  show-for-large  statutBar hide-for-print">

            {{--TITRE colorer -----------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci align-middle ">
                <div class="columns left "> Statistique </div>
                <div class="columns left"><i class="fa fa-pie-chart white "></i></div>
            </div>
            {{-- FIN titre colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE --------------------------------------------------------------------------------------------------------------}}
            <a href="">
                <div class="row padb15 align-middle  googleR bgW">
                    @include('stat.menu.menuTech')
                </div>
            </a>
            {{--FIN menu gauche ----------------------------------------------------------------------------------------------------------------}}

        </div>
        {{--FIN parti1 + entete------------------------------------------------------------------------------------------------------------------}}

        {{--BLOC PRINCIPALE MODULE----------------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-10 large-10 column SubContainer">

            {{--BARRE DE RACCOURCIT ------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci hide-for-print">
                <div class="medium-12 column">
                    @include('stat.raccourcit.racourcitTech')
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE--------------------------------------------------------------------------------------------------------}}
            <div class="row pad10">
                <div class="column bgW ">
                    <div class="row align-middle pad5">

                        <div class="column medium-1 fts_150 center show-for-medium hide-for-print">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>

                        <div class="column medium-11 hide-for-print">
                            <h4 class="googleB">Commandes expédiées</h4>
                            <p>
                                Cette page permet de visualiser la participation de la production de <b>{{$userGlobal[$request->user]['prenom']}} {{$userGlobal[$request->user]['nom']}}</b> .
                                <br>
                                Le tableau ci dessous , affiche le nombre de commande préparer /mois  , ainsi qu'une moyenne par mois également et une moyenne anuelle.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{---- QUELQUE CHIFFRE REPRESENTATIF-------------------------------------------------------------------------------------------------------------------------}}
            <div class="row pad10">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center show-for-medium hide-for-print" >
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-percent fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="column medium-11 ">
                            <div class="row"><div class="column"><h5 class="googleB">Quelques chiffres</h5></div></div>
                            <div class="row">
                                <div class="column">
                                    <p>Nombre de commandes total </p>
                                    <div class="stat">{{$commandYear}}</div>
                                </div>

                                <div class="column">
                                    <p>Nombre d'id sortie </p>
                                    <div class="stat">{{$numberItem}}</div>
                                </div>

                                <div class="column">
                                    <p>Moyenne d'id sortie par commandes</p>
                                    <div class="stat">{{$moyenneItemByCommand}}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp">

            {{----- TABLEAU AVEC NB COMMANDE / USER + MOYENNE + TOTAL ---------------------------------------------------------------------------------------------------}}
            <div class="row ">
                <table class="fts_080  hover">
                    <thead>
                    <tr >
                        <th class="" width="200"> Utilisateurs </th>
                        @foreach($calender as $month)
                            <th> {{substr($month,0,3)}} </th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td width="200" class="">{{$request->user}} - {{substr($userGlobal[$request->user]['prenom'],0,30)}}</td>
                        @foreach($calender as $keyMonth => $month)
                            <?php
                                if(isset($commandByMonth[$keyMonth]))//var_dump($commandByMonth[$keyMonth]);
                            ?>

                            <td class="center"> @if(isset($commandByMonth[$keyMonth])) {{$commandByMonth[$keyMonth]}}
                                @else
                                    -
                                @endif
                            </td>
                        @endforeach
                        <td class="center">{{array_sum($commandByMonth)}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp">

            <div class="row pad5 fts_080">
                <div class="column medium-12 large-12  border">

                    <div class="row borderb pad5 googleB">
                        <div class="column medium-2 large-2">Mois</div>
                        <div class="column medium-10 large-10">Commandes</div>
                    </div>

                    @foreach($calender as $keyMonth => $month)
                        <div class="row align-middle bgW borderb">
                            <div class="column medium-2 large-2 center googleB  small-2">{{$month}}</div>
                            <div class="column medium-10 large-10 borderl small-10">
                                @if(isset($detail[$keyMonth]))
                                    @foreach($detail[$keyMonth] as $keydetail => $valueDetail)
                                        <div class="row align-middle  borderb">
                                            <div class="column medium-2 pad5 small-2 large-2"><i class="fa fa-cube"></i> &nbsp {{$keydetail}}</div>
                                            <div class="column medium-10 borderl small-10 large-10">
                                                @foreach(collect($valueDetail)->chunk(4) As $chunk)
                                                    <div class="row">
                                                        @foreach($chunk as $id => $date)
                                                            <div class=" column pad5">
                                                                <span class="">ID{{$id}} </span> -<i class="fa fa-angle-right"></i> {{$date}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>


                <br>
            </div>

            <hr class="emp">

            {{--------MESSAGE AVERTISSEMENT PERTINENCE DONNEES-----------------------------------------------------------------------------------------------------------}}
            <div class="row hide-for-print">
                <div class="column ">
                    <i class="fa fa-warning red"></i> &nbsp; ces chiffres ne sont qu'a titre indicatif ,
                    ils ne tiennent aucunement compte du type de materiel préparer , de la difficulté de préparation ou du nombres de machines a préparer <i class="emp">dans</i> la commande &nbsp <i class="fa fa-warning red"></i>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <br>

        </div>
        {{--FIN bloc principal module--------------------------------------------------------------------------------------------------------------}}

    </div>
    {{----FIN container----------------------------------------------------------------------------------------------------------------------------}}


@stop