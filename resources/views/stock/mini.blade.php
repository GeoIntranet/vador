
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

            @foreach($sorties as $index => $sortie)

                @php $neuf =  0; $occase =  0; $reco =  0; $hs = 0; @endphp
                @php $count =  0 ; @endphp

                @if(isset($mini[$index]))
                    @php  $qte = $mini[$index]->first()->quantite; @endphp
                @else
                    @php  $qte = 0 @endphp
                @endif

                @if(isset($stock[$index][1]))
                    @php $count = $count + count($stock[$index][1]) @endphp
                    @php $neuf = count($stock[$index][1]) @endphp
                @endif

                @if(isset($stock[$index][11]))
                    @php $count = $count + count($stock[$index][11]) @endphp
                    @php $occase = count($stock[$index][11]) @endphp
                @endif

                @if(isset($stock[$index][21]))
                    @php $reco = count($stock[$index][21]) @endphp
                @endif

                @if(isset($stock[$index][22]))
                    @php $hs = count($stock[$index][22]) @endphp
                @endif

                @if($count < $qte)
                    @include('stock.toomin')
                @else
                    @include('stock.okmin')
                @endif
                    <br>
            @endforeach
        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------------------------------------}}
@stop