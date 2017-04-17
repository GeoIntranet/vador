@extends('templateModule')


@section('t')
    Locator Entrée en stock
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
            {!! Form::open(['action' => 'locatorController@postLastIn', 'method' => 'post']) !!}
            <div class="row">
                <div class="column medium-10">
                    {!! Form::text('filtre', old('filtre'), ['class' => 'locatorInput']) !!}
                </div>
                <div class="column medium-2">
                    {!! Form::submit('Filtre', ['class' => 'button blue']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            <hr class="emp locator">

            {{--ARTICLE--}}
            @include('locator.article.article')
            {{-----}}
            <br>
            <div class="row pad10">
                <div class="column bg_blue padl5">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
        {{--fin MODULE--}}
    </div>
    {{----FIN CONTAINER-----}}
@stop