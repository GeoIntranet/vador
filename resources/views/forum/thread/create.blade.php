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
                    {!! Form::submit('Recherche', ['class' => 'button blue']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <hr>
            <div class="row">
                <div class="column">
                    <h6>Nouveau Sujet</h6>
                </div>
            </div>
            <div class="row">
                <div class="column">


                    {!! Form::open(['action' => 'ThreadController@store', 'method' => 'post']) !!}
                    <div class="row">


                        <div class="column">
                            <label for="title">Titre:</label>
                            {!! Form::text('title', '', ['class' => 'locatorInput']) !!}
                        </div>
                        <div class="column">
                            <label for="channel_id">Choose a Channel:</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">Choose One...</option>

                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            {!! Form::textarea('body', '', ['id'=> 'editor','class' => 'locatorInput']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="column right">
                            {!! Form::submit('Création', ['class' => 'button blue']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <br>
        </div>
        {{--fin MODULE--}}


    </div>
    {{----FIN CONTAINER-----}}
@stop