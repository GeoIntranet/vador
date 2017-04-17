
@extends('templateModule')


@section('t')
    Statistique utilisateur
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('content')
    <br/>
    {{--CONTAINER------------------------------------------------------------------------------------------------------------------------------}}
    <div class="row incidentContainer pad5">

        {{--PARTI 1 MENU + ENTETE---------------------------------------------------------------------------------------------------------------}}
        <div class="medium-2 large-2  column  show-for-large  statutBar hide-for-print">

            {{--TITRE colorer -----------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci align-middle ">
                <div class="columns left "> Statistique </div>
                <div class="columns left"><i class="fa fa-pie-chart white "></i></div>
            </div>
            {{-- FIN titre colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE --------------------------------------------------------------------------------------------------------------}}
            <a href="">
                <div class="row padb15 align-middle  googleR bgW">
                    @include('stat.menu.menuFamille')
                </div>
            </a>
            {{--FIN menu gauche ----------------------------------------------------------------------------------------------------------------}}

        </div>
        {{--FIN parti1 + entete------------------------------------------------------------------------------------------------------------------}}

        {{--BLOC PRINCIPALE MODULE----------------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-10 large-10 column SubContainer">

            {{--BARRE DE RACCOURCIT ------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci hide-for-print">
                <div class="medium-12 column">
                    @include('stat.raccourcit.racourcit')
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE--------------------------------------------------------------------------------------------------------}}
            <div class="row pad10">
                <div class="column bgW ">
                    <div class="row align-middle pad5">

                        <div class="column medium-1 fts_150 center show-for-medium hide-for-print">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-cubes fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>

                        <div class="column medium-11 hide-for-print">
                            <h4 class="googleB">Liste des familles</h4>
                            <p>
                                Cette page nous affiche les différentes famille crée ainsi que la catégorie a laquelle elle a été assigné.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}
            <hr class="emp">

            {{----- TABLEAU AVEC NB COMMANDE / USER + MOYENNE + TOTAL ---------------------------------------------------------------------------------------------------}}
            <div class="row ">
                <table class="fts_090">

                    <thead>
                        <tr>
                            <th> Famille </th>
                            @foreach($categorieName as $keyCat => $valCat)
                                <th>{{$valCat}}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                       @foreach($categories as $indexCategorie => $categorie)
                           <?php unset($categorie->tps) ?>
                           <?php unset($categorie->mo) ?>
                           <tr>

                            @foreach($categorie->toArray() as $kcat => $vcat)

                                @if($kcat == 'famille')
                                    <td class=""><a href="{{route('stat.famille.show',['id'=>$vcat])}}">{{$vcat}}</a></td>
                                @else
                                    @if($vcat == '1')
                                        <td class="center"> <i class="fa fa-check-circle green"></i> </td>
                                    @else
                                        <td class="center"> - </td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row ">
                <div class="column center">
                    @if(method_exists($categories,'links'))
                        {{ $categories->links() }}
                    @endif

                </div>
            </div>

        </div>
        {{--FIN bloc principal module--------------------------------------------------------------------------------------------------------------}}

    </div>
    {{----FIN container----------------------------------------------------------------------------------------------------------------------------}}


@stop