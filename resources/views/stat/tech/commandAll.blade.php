
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

        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-10 large-10 column SubContainer">

            {{--BARRE DE RACCOURCIT ------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci hide-for-print">
                <div class="medium-12 column">
                    @include('stat.raccourcit.racourcitTech')
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE--------------------------------------------------------------------------------------------------------}}
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
                            <h4 class="googleB">Commandes expédiées</h4>
                            <p>
                                Cette page permet de visualiser la participation de la production de chaque utilisateur .
                                <br>
                                Le tableau ci dessous , affiche le nombre de commande préparer par utilisateur et par mois , ainsi qu'une moyenne par mois également et une moyenne anuelle.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{---- QUELQUE CHIFFRE REPRESENTATIF-------------------------------------------------------------------------------------------------------------------------}}
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
                                    <p> commandes sur l'année </p>
                                    <div class="stat">{{$nombreCommandeYear}}</div>
                                </div>

                                <div class="column">
                                    <p>Moyenne /pers </p>
                                    <div class="stat">{{$total}} </div>
                                </div>
                                <div class="column">
                                    <p>Nombre d'id sortie</p>
                                    <div class="stat"> -  </div>
                                </div>
                                <div class="column">
                                    <p>Moyenne d'id sortie </p>
                                    <div class="stat"> - </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp">
            <div class="row show-for-print">
                <div class="column">
                    Commandes
                </div>
            </div>
            {{----- TABLEAU AVEC NB COMMANDE / USER + MOYENNE + TOTAL ---------------------------------------------------------------------------------------------------}}
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

                        @foreach($detail as $keys => $values )
                            <?php $counting[$keys] = 0; ?>
                            <tr>
                                <td width="200" class="">{{$keys}} - {{substr($userGlobal[$keys]['prenom'],0,30)}}</td>

                                <?php $i = 1?>
                                @foreach($calender as $keyMonth => $month)

                                    <?php if (isset($values[$keyMonth])) $counting[$keys] = $counting[$keys] + count($values[$keyMonth]); ?>
                                    <td class="center"> @if(isset($values[$keyMonth])) {{count($values[$keyMonth])}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endforeach
                                <td class="center">{{$counting[$keys]}}</td>
                            </tr>

                        @endforeach
                        <tr>
                            <td class="center"><b>MOYENNE</b></td>
                            <?php $total = 0; ?>
                            @foreach($moyenne as $note)
                                <?php $total = $total + $note ?>
                                <td class="center b">@if($note == 0)- @else {{$note}}@endif</td>
                            @endforeach
                            <td class="center b">{{$total}}</td>
                        </tr>
                        </tbody>
                    </table>
                <br>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp hide-for-print">

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
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------}}
@stop