@extends('templateModule')


@section('t')
    Locator visualisation
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
            {{------------}}

            {{--ZONE DE RECHERCHE DU LOCATOR----------}}
            @include('locator.search')
            {{-- fin recherche--}}

            <hr class="emp locator">

            {{--ARTICLE--}}
            @include('locator.article.article')
            {{-----}}
            <br>

            <div class="row">
                <div class="column medium-12"></div>
            </div>

        </div>
        {{--fin MODULE--}}
    </div>
    {{----FIN CONTAINER-----}}
@stop