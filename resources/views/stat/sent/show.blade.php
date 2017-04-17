
@extends('templateModule')


@section('t')
    Statistique utilisateur
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
                <div class="columns left "> Statistique </div>
                <div class="columns left"><i class="fa fa-area-chart white "></i></div>

            </div>
            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE --------------------------------------------------------------------------------------------------------------}}

                <div class="row padb15 align-middle  googleR bgW">
                    @include('stat.menu.menuSentShow')
                </div>

            {{--FIN MENU GAUCHE -----------------------------------------------------------------------------------------------------------------}}

        </div>
        {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}

        {{--BLOC QUI LE MODULE-----------------------------------------------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-10 large-10 column SubContainer">

            {{--BARRE DE RACCOURCIT -----------------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci ">
                <div class="medium-12 column">
                    @include('stat.raccourcit.raccourcitSent')
                </div>
            </div>
            {{---------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE------------------------------------------------------------------------------------------------------------}}
            <?php
            $client_ = isset($clients[$bls[$bl]]) ? $clients[$bls[$bl]] : 'Client inconnu' ;
            $inconnu = 'Client inconnu'
            ?>
        @if( ! $lignes->isEmpty())
            <div class="row pad10">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-info fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">Information</h4>
                            <p>

                                Cette page permet de visualiser les donné integrer pour le bl <u>{{$bl}} - {{$client_}}</u>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

        @if($lignes->isEmpty())
            <div class="row pad10">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x orange"></i>
                          <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>
                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">Attention</h4>
                            <p>
                               Aucune information enregistrer dans la base de donnée , pour ce BL <u>{{$bl}} - {{$client_}}</u>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @else

            <div class="row pad10 ">
                <div class="column medium-12 large-12 small-12  bgW">

                    <div class="row">
                        <div class="column pad10">
                            <h4> <i class="fa fa-eye"></i> - Vu information sur integration commande <span class="emp">{{$bl}}</span>  </h4>
                        </div>
                    </div>

                    <table class="fts_080">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Désignation</th>
                            <th>Déscription</th>
                            <th>qte_c</th>
                            <th>qte_l</th>
                            <th>qte_f</th>
                            <th>Catégorie</th>
                            <th>Prestation</th>
                            <th>Prix</th>
                            <th>Edition</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $total = 0; ?>
                        @foreach($lignes as  $valueLigne)
                            <?php
                                    $existCat = isset($catGlobal[$cat[$valueLigne->id]['selected']]);
                            ?>
                            <tr>
                                <td class="center">{{$valueLigne->commande_ligne}}</td>
                                <td class="center">{{$valueLigne->designation}}</td>
                                <td class="center">{{$valueLigne->description}}</td>
                                <td class="center">{{$valueLigne->qt_c}}</td>
                                <td class="center">{{$valueLigne->qt_l}}</td>
                                <td class="center">{{$valueLigne->qt_f}}</td>
                                <td class="center">@if($existCat){{$catGlobal[$cat[$valueLigne->id]['selected']]}} @else - @endif</td>
                                <td class="center">{{$presta[$valueLigne->prestation]}}</td>
                                <td class="center">{{$valueLigne->prix_unit}} <i class="fa fa-euro"></i></td>
                                <td class="center"><a href="{{route('showBlInteger',['bl' => $valueLigne->bl , 'l'=> $valueLigne->id])}}"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                            <?php $total = $total + $valueLigne->total ?>
                        @endforeach
                        <tr>
                            <td colspan="8" class="b googleB fts_120">TOTAL</td>
                            <td colspan="2" class="center b googleB fts_120" >{{$total}} <i class="fa fa-euro"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if( ! $lignes->isEmpty())
            <di class="row pad10">
                <div class="column medium-12 small-12 large-12 ">

                    <div class="row">
                        <div class="column">
                            <?php //var_dump($cat) ?>
                        </div>
                    </div>

                    <?php $ligneError = 1 ?>

                    @if( ($ligneError == 0) )

                    <div class="row">
                        <div class="column">
                            <h4>Clique sur le petit icone crayon pour editer une ligne </h4>
                        </div>
                    </div>

                    @else
                    <div class="row">
                        <div class="column">
                            <h4> <i class="fa fa-pencil"></i>  - Modification integration commande - Ligne n°@if(isset($ls->commande_ligne)){{$ls->commande_ligne}} @else - @endif </h4>
                        </div>
                    </div>
                    <div class="row">

                    </div>

                        <div class="row  ">
                            <div class="column ">
                                <h5 class=" b googleB">Catégories</h5>
                            </div>
                        </div>

                            <div class="row  ">
                                @foreach($catGlobal as  $catGlobalKey_ => $catGlobalvalue_ )
                                <div class="column medium-4 small-5 large-2 pad5 center fts_070 ">

                                    <?php
                                        //var_dump($cat);
                                        //var_dump($ls->id);
                                        //var_dump($catGlobalKey_);
                                    ?>
                                    @if(isset($ls->id))
                                        @if($cat[$ls->id]['all'][$catGlobalKey_] == 1)
                                            <a href="{{route('editBl',['id' => $ls->id, 'arg' =>'categorie' ,'value' => $catGlobalKey_])}}"><div class=" categorieButton selected"><b>{{$catGlobal[$catGlobalKey_]}}</b></div></a>
                                        @else
                                            <a href="{{route('editBl',['id' => $ls->id, 'arg' =>'categorie' ,'value' => $catGlobalKey_])}}"><div class="categorieButton b ">{{$catGlobal[$catGlobalKey_]}}</div></a>
                                        @endif
                                    @else
                                     -
                                    @endif

                                </div>

                                @endforeach
                            </div>
                    <div class="row pad10 ">
                        <div class="column  ">
                            <h5 class="b googleB">Prestations</h5>
                        </div>
                    </div>

                    <div class="row pad5 ">

                        @foreach($presta as  $kpresta => $prestation )
                        <div class="column medium-4 small-5 large-2 pad5 center fts_070">
                            <?php   ?>
                            @if(isset($ll[$l]))
                                @if($ll[$l] == $kpresta)
                                    <a href="{{route('editBl',['id' => $ls->id, 'arg' =>'prestation' ,'value' => $kpresta])}}"><div class="categorieButton selected">{{$prestation}}</div></a>
                                @else
                                    <a href="{{route('editBl',['id' => $ls->id, 'arg' =>'prestation' ,'value' => $kpresta])}}"><div class="categorieButton b ">{{$prestation}}</div></a>
                                @endif
                            @else
                                -
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif


                </div>
            </di>
        @else
                <hr>
                <br>
                <div class="row pad10">
                    <div class="column bgW ">
                        <div class="row align-middle pad5">
                            <div class="column medium-1 fts_150 center ">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x green"></i>
                          <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                        </span>
                            </div>
                            <div class="column medium-11 ">
                                <h4 class="googleB">Intégration</h4>
                                <p>
                                    Click <a href="{{route('integerBl',['bl'=>$bl])}}"> <b><u>ICI</u></b></a> pour integrer le BL </u>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>
        @endif







<br>
        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------------------------------------}}
@stop