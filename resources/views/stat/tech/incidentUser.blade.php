
@extends('templateModule')


@section('t')
    Statistique utilisateur
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('content')

    <br/>
    {{--CONTAINER-------------------------------------------------------------------------------------------------------------------------------------------------------------}}
    <div class="row incidentContainer pad5">

        {{--BLOC QUI CONTIENT LE MENU + TITRE COLORER --------------------------------------------------------------------------------------------------------------------------}}
        <div class="medium-2 large-2  column  show-for-large  statutBar hide-for-print">

            {{--TITRE colorer -----------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci align-middle ">
                <div class="columns left "> Statistique </div>
                <div class="columns left"><i class="fa fa-pie-chart white "></i></div>

            </div>
            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE --------------------------------------------------------------------------------------------------------------}}
            <a href="">
                <div class="row padb15 align-middle  googleR bgW">
                    @include('stat.menu.menuTech')
                </div>
            </a>
            {{--FIN MENU GAUCHE -----------------------------------------------------------------------------------------------------------------}}

        </div>
        {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}

        {{--BLOC QUI LE MODULE-----------------------------------------------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-10 large-10 column SubContainer">

            {{--BARRE DE RACCOURCIT -----------------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci hide-for-print">
                <div class="medium-12 column">
                    @include('stat.raccourcit.racourcitTech')
                </div>
            </div>
            {{---------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE------------------------------------------------------------------------------------------------------------}}
            <div class="row pad10 hide-for-print">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i>
                            </span>

                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">Incidents gérer</h4>
                            <p>
                                Cette page permet de visualiser le nombre d'incident qui ont été gerer par chaque utilisateur .
                                <br>
                                Le tableau ci dessous , affiche le nombre d'incident traité par utilisateur et par mois , ainsi qu'une moyenne par mois et une moyenne anuelle.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{---- QUELQUE CHIFFRE REPRESENTATIF------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row pad10 hide-for-print">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-percent fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="column medium-11 ">
                            <div class="row"><div class="column"><h5 class="googleB">Quelques chiffres</h5></div></div>
                            <div class="row">
                                <div class="column">
                                    <p> incidents sur l'année </p>
                                    <div class="stat"></div>
                                </div>

                                <div class="column">
                                    <p>Moyenne /pers </p>
                                    <div class="stat"> </div>
                                </div>
                                <div class="column">
                                    <p>Temps moyen de gestion</p>
                                    <div class="stat"> </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row show-for-print">
                <div class="column">
                    Incidents
                </div>
            </div>
            <hr class="emp">

            {{----- TABLEAU AVEC NB INCIDENT / USER + MOYENNE + TOTAL ---------------------------------------------------------------------------------------------------}}
            <div class="row ">
                <table class="fts_080 ">
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
                    @foreach($participation as $keys => $values )
                        <?php $counting[$keys] = 0; ?>
                        <tr>
                            <td width="200" class="">{{$keys}} - {{substr($userGlobal[$keys]['prenom'],0,30)}}</td>

                            <?php $i = 1?>
                            @foreach($calender as $keyMonth => $month)
                                <td class="center">
                                    @if(isset($values['countByMonth'][$keyMonth]))
                                        {{$values['countByMonth'][$keyMonth]}}
                                    @endif
                                </td>
                            @endforeach
                            <td class="center">{{$values['count']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp">

            <div class="row pad5 fts_080">
                <div class="column medium-12 large-12  border bgW">

                    <div class="row borderb pad5 googleB">
                        <div class="column medium-2 large-2">Mois</div>
                        <div class="column medium-10 large-10">Incidents</div>
                    </div>

                    @foreach($calender as $keyMonth => $month)

                        <div class="row align-middle bgW borderb">
                            <div class="column medium-1 large-1 center googleB  small-2">{{$month}}</div>
                            <div class="column medium-11 large-11 borderl small-10">
                                @if(isset($values['detail'][$keyMonth]))
                                    @foreach(  collect($values['detail'][$keyMonth])->chunk(4) as $chunk )
                                        <div class="row align-middle  borderb">
                                            @foreach($chunk as $kchunk => $vchunk)
                                                <div class="column medium-3 pad5 small-3 large-3">
                                                     <u>{{$kchunk}}</u> <i class="fa fa-angle-right"></i> {{substr($vchunk,0,17)}}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        <br>
                    @endforeach
                </div>
                <br>
            </div>

            <hr class="emp">

            {{--------MESSAGE AVERTISSEMENT PERTINENCE DONNEES-----------------------------------------------------------------------------------------------------------}}
            <div class="row hide-for-print">
                <div class="column ">
                    <i class="fa fa-warning red"></i> &nbsp; ces chiffres ne sont qu'a titre indicatif ,
                    ils ne tiennent aucunement compte de l'excluvité de traitement de l'incident ni du <i class="emp">temps</i> passé a le resoudre &nbsp <i class="fa fa-warning red"></i>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <br>

        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------}}
@stop