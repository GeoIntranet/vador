@extends('templateModule')


@section('t')
    Forum
@stop


@section('menu')
    @locatorlude('menu.navbars')
@stop

@section('content')

    <br/>
    {{--CONTAINER----------------------------------------------------------------------------------------------------------------------------}}
    <div class="row locatorContainer pad5 ">

        {{--BLOC QUI CONTIENT LE MENU + TITRE COLORER -----------------------------------------------------------------------------------------}}
        <div class="medium-2 large-2  column  show-for-large  statutBar">
            {{--TITRE colorer -----------------------------------------------------------------------------------------------------------------}}
            @include('forum.title')


            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE ---------------}}
            @include('forum.menu.menu')
            {{--FIN MENU GAUCHE ----------------------}}
        </div>
        {{---------------------------}}

        {{--BLOC QUI LE MODULE-------------}}
        <div class="small-12 medium-10 large-10 column SubContainer ">

            {{--BARRE DE RACCOURCIT ---------------}}
            <div class="row locatorRaccourci ">
                <div class="medium-12 column">
                    @include('forum.raccourcit.raccourcit')
                </div>
            </div>
            <br>
            {{------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE--------------------------------------------------------------------------------------------------------}}
            <div class="row pad10 hide-for-print">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x blue"></i>
                              <i class="fa fa-book fa-stack-1x fa-inverse"></i>
                            </span>

                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">Forum</h4>
                            <p>
                                Cette page vous permet d'afficher les différents article du catalogue. <br>
                                Vous pouver filtrer vos la recherche par mot clé.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {!! Form::open(['action' => 'locatorController@postCatalogue', 'method' => 'post']) !!}
            <div class="row">
                <div class="column">
                    @if(session()->has('error_xx'))
                        <span class="red b ">{{session()->get('error_xx')}}</span>
                    @endif
                </div>
            </div>

            <div class="row ">
                <div class="column medium-10">
                    {!! Form::text('filtre', old('filtre'), ['class' => 'locatorInput']) !!}
                </div>
                <div class="column medium-2">
                    {!! Form::submit('Recherche', ['class' => 'button blue']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <div class="row">
                <div class="column">
                    <h3>{{$thread->title}}</h3>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    {{$thread->body}}
                </div>
            </div>
            <div class="row fts_075">
                <div class="column">
                    par {{userName($thread->createur->USER_id)}} le {{$thread->created_at}}
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="column">
                    <a href="{{action('RepliesController@store',[$thread->channel_id,$thread])}}" class="button blue">Repondre</a>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <h6><u>Reponses</u></h6>
                </div>
            </div>

            @foreach($replies as $reply)
                <div class="row">
                    <div class="column">
                        {{$reply->body}}
                    </div>
                </div>
                <div class="row fts_075">
                    <div class="column">
                        par {{userName($reply->owner->USER_id)}} le {{$reply->created_at}}
                    </div>
                </div>
            @endforeach


        </div>

        {{--fin MODULE--}}


    </div>
    {{----FIN CONTAINER-----}}
@stop