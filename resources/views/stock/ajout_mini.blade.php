
@extends('templateModule')


@section('t')
    Stock Mini
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
                <div class="columns left "> Stock Mini </div>
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
                    @include('stock.raccourcitStockMini')
                </div>
            </div>
            {{---------------------------------------------------------------------------------------------------------------------------------------------------------------}}
            <br><br>

            <div class="row">
                <div class="column medium-12" style="height:500px">

                    <h1>Ajout stock mini</h1>
                    <form action="{{action('StockController@ajoutMini')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="medium-6 cell">
                            <label>Article
                                <input type="text" name="article" placeholder="votre reference article">
                            </label>
                        </div>
                        <div class="medium-6 cell">
                            <label>Quantité
                                <input type="number" name="quantite" placeholder="nombre de pièces souhaité ">
                            </label>
                        </div>
                        <div class="medium-6 cell">
                            <label>Information
                                <input type="text" name="comment" placeholder="Information sur la demande">
                            </label>
                        </div>
                        <label for="exampleFileUpload" class="button">Ajout</label>
                        <input type="submit" id="exampleFileUpload" class="show-for-sr">
                    </form>
                </div>
            </div>

        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------------------------------------}}
@stop