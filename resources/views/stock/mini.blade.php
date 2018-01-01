
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

            @foreach($stockMini as $nom_article => $article)

                @php $neuf =  0; $occase =  0; $reco =  0; $hs = 0; @endphp
                @php $count =  0 ; @endphp
                @php $qte =  $article->first()->quantite @endphp

                @if(isset($stockReel[$nom_article][1]))
                    @php $count = $count + count($stockReel[$nom_article][1]) @endphp
                    @php $neuf = count($stockReel[$nom_article][1]) @endphp
                @endif

                @if(isset($stockReel[$nom_article][11]))
                    @php $count = $count + count($stockReel[$nom_article][11]) @endphp
                    @php $occase = count($stockReel[$nom_article][11]) @endphp
                @endif

                @if(isset($stockReel[$nom_article][21]))
                    @php $reco = count($stockReel[$nom_article][21]) @endphp
                @endif

                @if(isset($stockReel[$nom_article][22]))
                    @php $hs = count($stockReel[$nom_article][22]) @endphp
                @endif

                @if($count < $qte)
                    <a href="{{action('StockController@miniEdit',['id'=>$stockMini[$nom_article]->first()->id])}}">
                        @include('stock.toomin')
                    </a>

                @else
                    <a href="{{action('StockController@miniEdit',['id'=>$stockMini[$nom_article]->first()->id])}}">

                    @include('stock.okmin')
                    </a>

                @endif
                <br>

            @endforeach


        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------------------------------------}}
@stop