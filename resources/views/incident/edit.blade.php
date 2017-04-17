@extends('templateModule')


@section('t')
    Incidents vue
@stop



@section('content')
    <br/>
    <div class="row incidentContainer ">

        <div class="medium-3 column  show-for-large  statutBar">

            {{--TITRE colorer -----------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci ">
                <a href="{{route('incident.index')}}">
                    <div class="medium-12 column center b white">
                        <i class="fa fa-bell white"></i> &nbsp Incidents utilisateur
                    </div>
                </a>
            </div>
            {{-- FIN TITRE colorer--------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE ---------------------------------------------------------------------------------------------------------------}}
            @if($incidents <> NULL)
                @foreach($incidents as $kincu => $vincu)
                    <a href="{{route('incident.show',$vincu->id_incid)}}">
                        <div class="row fts_080 padt15 padb15 align-middle listInc googleR">
                            <div class="medium-3 column">
                                <i class="fa fa-angle-right"></i>  {{$vincu->id_incid}}
                                <span class="fts_075 b">{{substr($vincu->nsoc,0,8)}}</span>
                            </div>
                            <div class="medium-9 column">{{strtolower(substr($vincu->titre,0,50))}}</div>
                        </div>
                    </a>
                @endforeach
            @endif
            {{--FIN MENU GAUCHE -------------------------------------------------------------------------------------------------------------------}}

        </div>

        {{--BLOC QUI CONTIENT TOUT L'INCIDENT-------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-12 large-9 column SubContainer">

            {{--BARRE DE RACCOURCIT ------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci ">
                <div class="medium-12 column">
                    @include('incident.raccourcit.raccourcitIncident')
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--BARRE INFORMATION INCIDENT-------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row incBarreInfo">

                <div class="small-12 large-5 medium-12 column sep">

                    <div class="row ">
                        <div class="small-12 medium-12 column sub">
                            <h4 class="googleB"> <i class="fa fa-warning red"></i>&nbsp INCIDENT <span class="emp">{{$incident['id_incid']}}</span ></h4>
                            <p class="googleR"> <i class="fa fa-twitch"></i> {{$incident['titre']}}</p>
                        </div>

                        <div class="small-12 medium-12 column ">
                            <h5 class="googleT b"> <i class="fa fa-star yellow"></i> <span class="emp">{{$incident['nsoc']}}</span> (   )</h5>
                            <h6 class="googleT b"><i class="fa fa-map-marker dk"></i> &nbsp{{$incident['adr1']}}</h6>
                            <h6 class="googleT b"><i class="fa fa-angle-right dk"></i> &nbsp{{$incident['cp']}} {{$incident['ville']}} </h6>
                        </div>
                    </div>
                </div>

                <div class="small-12 large-4 medium-12 column sep ">
                    <div class="row">
                        <div class="medium-12 column">
                            <h4 class="googleB">COMMANDE <span class="emp">{{$incident['id_cmd']}}</span></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 column">
                            <h6 class="googleR"><i class="fa fa-user"></i> Vendeur :  fri<br/></h6>
                            <h6 class="googleR"><i class="fa fa-angle-right"></i> Code cmd :  546456456<br/></h6>
                            <h6 class="googleR"><i class="fa fa-clock-o"></i> Date commandes : 2016-05-15  <br/></h6>
                            <h6 class="googleR"><i class="fa fa-clock-o"></i> Date livraison : 2016-05-15  <br/></h6>
                        </div>
                    </div>
                    @if( TRUE)
                        <div class="row">
                            <div class="medium-offset-2 medium-8 column center CliStatutSucess">
                                <i class="fa fa-ban"></i> &nbsp Client non bloqué
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="medium-offset-2 medium-8 column center CliStatutWarning">
                                <i class="fa fa-ban"></i> &nbsp Client bloqué
                            </div>
                        </div>
                    @endif
                </div>

                <div class="large-3 show-for-large column ">

                    <h5 class="googleB"> Preparateur gv </h5>

                    <h6 class="googleR"><i class="fa fa-user"></i> 48 <br/></h6>
                    <h6 class="googleR fts_080">Transport :  alloin<br/></h6>
                    <h6 class="googleR fts_080">Bon de tps :  3121245<br/></h6>
                    <h6 class="googleR fts_080">Poid du colis : 15 kg  <br/></h6>
                    <h6 class="googleR fts_080">Facturé : oui  <br/></h6>

                </div>

            </div>
            {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{----BARRE INCIDENT HEAD--------------------------------------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row  fts_090 pad5 incBarreHead">
                <div class="small-6 large-3 medium-6 column sub">

                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x dk"></i>
                      <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                    </span>

                    {{$incident['contact']}}
                </div>
                <div class="small-6 large-3 medium-6 column sub">

                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x dk"></i>
                      <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                    </span>
                    {{ $incident['tel']}}
                </div>
                <div class="small-12 large-3 medium-6 column sub">

                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x dk"></i>
                      <i class="fa fa-print fa-stack-1x fa-inverse"></i>
                    </span>
                    SN : {{$incident['num_serie']}}
                </div>
                <div class="small-12 large-3 medium-6 column center">

                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x dk"></i>
                      <i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
                    </span>
                    Garantie : {{$incident['id_garant']}}
                </div>

            </div>
            {{-----------------------------------------------------------------------------------------}}

            {{-----INCIDENT CONTENT--------------------------------------------------------------------}}
            <div class="row  align-middle incBarreContent  googleR">
                <div class=" show-for-large medium-2 column incidentInfo">
                    <i class="fa fa-info-circle"></i> Info
                </div>
                <div class="small-12 medium-10 column padt15  incidentContent">
                    <p>
                        {!! substr($incident['explic'],0,-1) !!}
                    </p>
                </div>
            </div>
            {{-----------------------------------------------------------------------------------------}}
            <hr>
            <div class="row">
                <div class="column small-12 medium-12 large-12 border_dash">
                    {{ Form::model($incident,['action' => ['IncidentController@update',$id], 'method' => 'PUT']) }}

                    <label>Edition
                        {!! Form::textarea('body', '', ['placeholder'=> 'Edite cet incident','class' => 'horaireInput']) !!}
                    </label>
                        <div class="row">
                            <div class="column medium-6 large-6 small-12">
                                {!! Form::label('who', 'A qui', ['class' => '']) !!}
                                {!! Form::select('who', $users , null , ['class' => 'horaireInput']) !!}
                            </div>

                            <div class="column medium-6 large-6 small-12">
                                {!! Form::label('action', 'Actions', ['class' => '']) !!}
                                {!! Form::select('action', $actions , null , ['class' => 'horaireInput']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="column medium-12 large-12 small-12 right">
                                {!! Form::submit('Valider', ['class' => 'button sucess']) !!}
                            </div>
                        </div>



                    {!! Form::close() !!}
                    <br>
                </div>
            </div>

        </div>

    </div>

@stop

