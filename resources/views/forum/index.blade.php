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
                @include('forum.presentation')
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {!! Form::open(['action' => 'locatorController@postCatalogue', 'method' => 'post']) !!}
            <div class="row">
                <div class="column">
                    @if(session()->has('error_catalogue'))
                        <span class="red b ">{{session()->get('error_catalogue')}}</span>
                    @endif
                </div>
            </div>

            <div class="row ">
                <div class="column medium-10">
                    {!! Form::text('filtre', old('filtre'), ['class' => 'locatorInput']) !!}
                </div>
                <div class="column medium-2">
                    {!! Form::submit('Recherche', ['class' => "button $color"]) !!}
                </div>
            </div>
            {!! Form::close() !!}

            @foreach($threads as $thread)
                <div class="row  pad10 align-middle">
                    <?php
                    $ico = $thread->createur->USER_icone;
                    $url = url("imgs/trombinoscope/32x32/$ico");
                    ?>

                    <div class="column medium-1 center">
                        <img class="forum_avatar" src={{$url}} />
                    </div>
                    <div class="column medium-9 ">
                        <div class="row">
                            <div class="column">
                                <a href="{{action('ThreadController@show',[$thread->channel_id,$thread->id])}}">{{$thread->title}}</a>
                            </div>
                        </div>
                        <div class="row fts_080 ">
                            <div class="column">
                                par {{userName($thread->createur->USER_id,'noID')}} - {{$thread->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="row padl10 fts_080">
                            <div class="column  ">
                                <?php $body = substr( strip_tags ($thread->body),0,60) ?>
                                {!!  $body !!} ...
                            </div>
                        </div>

                    </div>

                    <div class='column medium-2 b fts_060 {{$color}}' >
                        <span class="fa-stack fa-3x fts_200">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <strong class="fa-stack-1x text-primary white fts_075">{{$thread->replies_count}}</strong>
                       </span>

                    </div>
                </div>
                <hr class="emp">
            @endforeach
        </div>
        {{--fin MODULE--}}


    </div>
    {{----FIN CONTAINER-----}}
@stop