@extends('templateModule')


@section('t')
    Locator sortie
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
            <div class="row locatorRaccourci align-middle ">
                <div class="columns left "> Locator</div>
                <div class="columns left"><i class="fa fa-area-chart white "></i></div>
            </div>

            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE ---------------}}
            @include('locator.menu.menu')
            {{--FIN MENU GAUCHE ----------------------}}
        </div>
        {{---------------------------}}

        {{--BLOC QUI LE MODULE-------------}}
        <div class="small-12 medium-10 large-10 column SubContainer ">

            {{--BARRE DE RACCOURCIT ---------------}}
            <div class="row locatorRaccourci ">
                <div class="medium-12 column">
                    @include('locator.raccourcit.raccourcit')
                </div>
            </div>
            <br>
            {{------------}}
            {!! Form::open(['action' => 'locatorController@postMultiId', 'method' => 'post']) !!}
                <div class="row">
                    <div class="column">
                        @if(session()->has('errorMulti'))
                            <span class="red b ">{{session()->get('errorMulti')}}</span>
                        @endif
                    </div>
                </div>

                <div class="row ">
                    <div class="column medium-10">
                        {!! Form::text('multi', old('multi'), ['class' => 'locatorInput']) !!}
                    </div>
                    <div class="column medium-2">
                        {!! Form::submit('Recherche', ['class' => 'button blue']) !!}
                    </div>
                </div>
            {!! Form::close() !!}

            <hr class="emp locator">
            @if(session()->has('dataMultiple'))

                <div class="row">
                    <div class=" column medium-1 pad10">
                        <a href="{{action('locatorController@getMultiOut')}}"><i class="fa fa-reply fa-2x"></i></a>
                    </div>
                    <div class=" column medium-1 pad10">
                        <a href="{{action('locatorController@getMultiDeplacement')}}"><i class="fa fa-truck fa-2x"></i></a>
                    </div>
                </div>

                <div class="row">

                </div>

            @endif

            {{--ARTICLE--}}
            @include('locator.article.article')
            {{-----}}
        </div>
        {{--fin MODULE--}}
    </div>
    {{----FIN CONTAINER-----}}
@stop