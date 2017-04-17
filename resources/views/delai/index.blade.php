
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
                <div class="columns left "> Delais </div>
                <div class="columns left"><i class="fa fa-clock-o white  "></i></div>

            </div>
            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE --------------------------------------------------------------------------------------------------------------}}
            <a href="">
                <div class="row padb15 align-middle  googleR bgW">

                </div>
            </a>
            {{--FIN MENU GAUCHE -----------------------------------------------------------------------------------------------------------------}}

        </div>
        {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}

        {{--BLOC QUI LE MODULE-----------------------------------------------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-10 large-10 column SubContainer">

            {{--BARRE DE RACCOURCIT -----------------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci invisible">
                <div class="medium-12 column">
                    @include('delai.raccourcit.raccourcitIndex')
                </div>
            </div>
            {{---------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE------------------------------------------------------------------------------------------------------------}}
            <div class="row pad10 hide">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">XXXX</h4>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{---- QUELQUE CHIFFRE REPRESENTATIF------------------------------------------------------------------------------------------------------------------------------}}


            <div class="row pad10 hide">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-percent fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="column medium-11 ">
                            <div class="row"><div class="column"><h5 class="googleB">XXXXXX</h5></div></div>
                            <div class="row">
                                <div class="column">
                                    <p> xxxxxxxxx </p>
                                    <div class="stat"></div>
                                </div>

                                <div class="column">
                                    <p>xxxxxxxxxxxxx </p>
                                    <div class="stat"> </div>
                                </div>
                                <div class="column">
                                    <p>xxxxxxxxxxxxxxxxxxx</p>
                                    <div class="stat"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp">
            {{----- TABLEAU AVEC NB INCIDENT / USER + MOYENNE + TOTAL ---------------------------------------------------------------------------------------------------------}}
            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <table class="fts_090">
                
                <thead>
                    <tr>
                        <th>#</th>
                        <th>BL</th>
                        <th>Date </th>
                        <th>Client</th>
                        <th>Information  Production</th>
                        <th>Tags</th>
                    </tr>
                </thead>

                <tbody>
                <?php //var_dump($orders['final']); ?>
                <?php $i=1; ?>
                @foreach($orders['withDelais']->sortBy('dtExp') as $key => $value)
                    <tr class="fts_080">
                        <td class="" > <span class="with_delais">{{$i++}}</span></td>
                        <td class="" width="5%">{{$value->bl}}</td>
                        <td class="" width="10%"> {{$value->DateEnvoie}} </td>
                        <td class="" width="5%"> {{$value->Client['nsoc']}} <br>{{$value->Vendeur}}</td>

                        <td  class="">
                            @if(isset($cmdLignes[$value->bl]))

                                {{$value->codeClient}}<br>
                                @foreach($cmdLignes[$value->bl] as $indexLigne )
                                    {{$indexLigne}}<br>
                                @endforeach

                            @endif

                            @if(isset($da[$value->bl]))
                                <hr class="mini_delai">

                                <?php $das = $da[$value->bl];?>

                                @foreach($das as $indexDa => $da)

                                    <?php
                                        $da_ = $da['da'];
                                        $lastAction = $da['actions']->last();
                                        $po = $da['po'];
                                        $user= $lastAction['id_user'];
                                    ?>

                                        {{$da_['id_pd']}}
                                        - {{$lastAction['action']}}
                                        - {{$da_['qte_dem']}}
                                        / {{$da_['qte_cmd'] == null ? '-':$da_['qte_cmd']}}
                                        / {{$da_['qte_recu'] == null ? '-' : $da_['qte_recu']}}
                                        {{ucfirst(strtolower(substr($da_['description'],0,30)))}}
                                        - {{isset($gestion->users[$user]) ? substr($gestion->users[$user]['prenom'],0,1).'.'.$gestion->users[$user]['nom']  :'inconnue'.$user }}
                                        @if(isset($po['po_titre'])) - {{strtolower($po['po_titre'])}}@endif
                                        @if(isset($po['po_id'])) - n°{{strtolower($po['po_id'])}}@endif
                                        - {{$gestion->gestion->dateLisible($po['po_dt_prev_arr'],'minWithYear')}}
                                    <br>
                                @endforeach

                            @endif


                        </td>
                        <td width="10%">
                            @foreach($value->Tag as $tag)
                                <span class="has-tip[tip-bottom] has-tip tag "
                                      data-tooltip aria-haspopup="true" data-disable-hover="false"
                                      data-options='show_on:medium' title=" {{$tag['fullName']}}">
                                   {{$tag['abbr']}}
                                </span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9" class="center googleB"> COMMANDES SANS INFORMATION DELAIS </td>
                </tr>
                    @foreach($orders['withNoDelais'] as $key => $value)
                        <tr class="fts_085">
                            <td > <span class="with_no_delais">{{$i++}}</span></td>
                            <td>{{$value['bl']}}</td>
                            <td width="" class="center"> - </td>
                            <td width=""> {{$value['client']}} </td>

                            <td class="">@if($value['info_prod'] === null)- @else {!! $value['info_prod'] !!} @endif</td>
                            <td  width="" class="center"> - </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
            <hr class="emp">

            {{--------MESSAGE AVERTISSEMENT PERTINENCE DONNEES-----------------------------------------------------------------------------------------------------------------}}
            <div class="row hide">
                <div class="column ">
                    <i class="fa fa-warning red"></i>xxxxxxxxxxxxxxxxxx
                </div>
            </div>
            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}
            <br>
        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------------------------------------}}
@stop