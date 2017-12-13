
@extends('templateModule')


@section('t')
    Taches
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('content')

    <br/>
    {{--CONTAINER-------------------------------------------------------------------------------------------------------------------------------------------------------------}}
    <div class="row incidentContainer pad5">

        {{--BLOC QUI CONTIENT LE MENU + TITRE COLORER --------------------------------------------------------------------------------------------------------------------------}}
        <div class="medium-2 large-2  column  show-for-large  statutBar">

            {{--TITRE colorer -----------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci align-middle ">
                <div class="columns left "> TO DO </div>
                <div class="columns left"><i class="fa fa-globe white "></i></div>

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
            <div class="row incRaccourci ">
                <div class="medium-12 column">

                </div>
            </div>
            {{---------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE------------------------------------------------------------------------------------------------------------}}
            <div class="row pad10">
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


            <div class="row pad10">
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
            @php //var_dump($incidents->incident) @endphp
            Incident que l'on peut traité -
            


            @foreach($incidents->solvable as $presta => $incidents)

                @if($presta == 1)
                    <br>
                    <br>
                    <b> <u> LES GARANTIE SUR VENTES :</u></b>
                    @foreach($incidents as $index => $incident)
                        <div class="col-lg-3">
                            <b>{{$incident->id_incid}}</b>
                            -
                            {{ ($incident->nsoc) }}
                            -
                            <small>{!!strtolower($incident->titre)!!}</small>
                            -
                            <small class="">
                                @php $diff = (new \Carbon\Carbon())->diffInDays( new \Carbon\Carbon($incident->lastact)) @endphp
                                <span>le {{$incident->open->format('d/m')}}</span>
                            </small>
                        </div>
                    @endforeach
                @endif

                @if($presta == 4)
                        <br>
                        <br>
                        <b> <u>HORS GARANTIE : </u></b>
                    @foreach($incidents as $index => $incident)
                            <div class="col-lg-3">

                                <b>{{$incident->id_incid}}</b>
                                -
                                {{ ($incident->nsoc) }}
                                -
                                <small>{!! strtolower($incident->titre) !!}</small>
                                -
                                <small class="">
                                    @php $diff = (new \Carbon\Carbon())->diffInDays( new \Carbon\Carbon($incident->lastact)) @endphp
                                    <span>le {{$incident->open->format('d/m')}}</span>
                                </small>
                    @endforeach
                @endif

            @endforeach
            @php //var_dump($incidents->solvable) @endphp
            <hr class="emp">

            <hr class="emp">

            {{--------MESSAGE AVERTISSEMENT PERTINENCE DONNEES-----------------------------------------------------------------------------------------------------------------}}
            <div class="row">
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