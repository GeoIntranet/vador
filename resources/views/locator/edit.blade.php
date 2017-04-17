@extends('templateModule')


@section('t')
    Locator edit
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
            <div class="row bgW">
                <br>
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
            <div class="row align-middle">
                <div class="column medium-1 fts_150" >
                    <a href={{redirect()->back()->getTargetUrl()}}>
                     <span class="fa-stack fa-lg">
                       <i class="fa fa-circle fa-stack-2x blue"></i>
                       <i class="fa fa-angle-double-left fa-stack-1x fa-inverse"></i>
                     </span>
                    </a>
                </div>
                <div class="column medium-10">
                    <span class="fts_180">Edition de L'ID {{$locator->id->id_locator}}</span>
                </div>
            </div>

            <div class="row padr10 padl10 ">
                @include('locator.formEdit')
            </div>
            {{------------}}

            <br>

        </div>
        {{--fin MODULE--}}
    </div>
    {{----FIN CONTAINER-----}}
@stop