
@extends('templateModule')


@section('t')
    Commandes
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
            <div class="row incRaccourci align-middle hidden-print">
                <div class="columns left "> Delais </div>
                <div class="columns left"><i class="fa fa-clock-o white  "></i></div>

            </div>
            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE --------------------------------------------------------------------------------------------------------------}}
            <a href="">
                <div class="row padb15 align-middle  googleR bgW">
                    @include('delai.menu.menu')
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
                    @include('delai.raccourcit.raccourcitIndex')
                </div>
            </div>
            {{---------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE------------------------------------------------------------------------------------------------------------}}
            <div class="row pad10 hide">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">XXXX</h4>
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{---- QUELQUE CHIFFRE REPRESENTATIF------------------------------------------------------------------------------------------------------------------------------}}


            <div class="row pad10 hide">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x green"></i>
                              <i class="fa fa-percent fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="column medium-11 ">
                            <div class="row"><div class="column"><h5 class="googleB">XXXXXX</h5></div></div>
                            <div class="row">
                                <div class="column">
                                    <p> xxxxxxxxx </p>
                                    <div class="stat"></div>
                                </div>

                                <div class="column">
                                    <p>xxxxxxxxxxxxx </p>
                                    <div class="stat"> </div>
                                </div>
                                <div class="column">
                                    <p>xxxxxxxxxxxxxxxxxxx</p>
                                    <div class="stat"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp">
            {{----- TABLEAU AVEC NB INCIDENT / USER + MOYENNE + TOTAL ---------------------------------------------------------------------------------------------------------}}
            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <table class="fts_090">

                <thead>
                <tr>
                    <th>#</th>
                    <th>BL</th>
                    <th>Client</th>
                    <th>Tag</th>
                    <th>Information  Production</th>
                </tr>
                </thead>

                <tbody>


                <?php $i=1; ?>
                @if(isset($cmd->delaiRenderView))

                @foreach($cmd->delaiRenderView as $commande)
                    <tr class="fts_085 borderb">

                        <td class=""> <span class="with_delais">{{$i++}}</span></td>

                        <td width="150">
                            {{$commande->bl}}
                            <br>
                            pour le : {{$commande->date}}
                        </td>

                        <td width="">
                            {{$commande->client}}
                            <br>{!! $commande->user!!}
                        </td>

                        <td  width="100" class="center">
                            @if(isset($cmd->tags[$commande->bl]))
                                @foreach($cmd->tags[$commande->bl] as $tag)
                                    <span class="has-tip[tip-bottom] has-tip tag "
                                          data-tooltip aria-haspopup="true" data-disable-hover="false"
                                          data-options='show_on:medium' title=" {{$tag->fullName}}">
                                       {{$tag->abbr}}
                                    </span>
                                @endforeach
                            @endif
                        </td>

                        <td class="">

                            <br>
                            @if(isset($cmd->lignes[$commande->bl]))
                                @foreach($cmd->lignes[$commande->bl] as $lignes)
                                    {!!  $lignes    !!}
                                    <br>
                                @endforeach
                            @endif

                            @if(isset($cmd->achat->mapCmdToPd[$commande->bl]))
                                <hr class="emp">
                                @foreach($cmd->achat->mapCmdToPd[$commande->bl] as $key => $achat)

                                    <?php $da = $cmd->achat->achatRender[$achat] ?>
                                    {{$da->id}} -
                                    {{$da->qte_d}}/
                                    {{$da->qte_c}}/
                                    {{$da->qte_r}}/
                                    {{substr($da->description,0,30)}} -
                                    {{$da->user}} -
                                    {{$da->po}} -
                                    {{$da->fournisseur}} -
                                    {{$da->arrive}}
                                    <br>
                                @endforeach
                                <hr class="emp">
                        @endif
                        </td>
                    </tr>
                @endforeach

                @endif

                <tr>
                    <td colspan="5" class="center googleB"> COMMANDES SANS INFORMATION DELAIS </td>
                </tr>

                @foreach($cmd->renderView as $commande)
                    <tr class="fts_085 borderb">

                        <td class=""> <span class="with_no_delais">{{$i++}}</span></td>

                        <td width="90">
                            {{$commande->bl}}
                            <br>
                            {{$commande->date}}
                        </td>

                        <td width="">
                            {{$commande->client}}
                            <br>{!! $commande->user!!}
                        </td>

                        <td  width="100" class="center">
                            @if(isset($cmd->tags[$commande->bl]))
                                @foreach($cmd->tags[$commande->bl] as $tag)
                                    <span class="has-tip[tip-bottom] has-tip tag "
                                          data-tooltip aria-haspopup="true" data-disable-hover="false"
                                          data-options='show_on:medium' title=" {{$tag->fullName}}">
                                       {{$tag->abbr}}
                                    </span>
                                @endforeach
                            @endif
                        </td>

                        <td class="">

                            @if(is_numeric(substr($commande->info,0,1)))
                                <span class="red">pour le <u>{{substr($commande->info,0,5)}}</u></span>
                            @endif

                            <br>
                            <br>
                            @if(isset($cmd->lignes[$commande->bl]))
                                @foreach($cmd->lignes[$commande->bl] as $lignes)
                                    {!!  $lignes    !!}
                                    <br>
                                @endforeach
                            @endif

                            @if(isset($cmd->achat->mapCmdToPd[$commande->bl]))
                                    <hr class="emp">
                                 @foreach($cmd->achat->mapCmdToPd[$commande->bl] as $key => $achat)

                                     <?php $da = $cmd->achat->achatRender[$achat] ?>
                                     {{$da->id}} -
                                     {{$da->qte_d}}/
                                     {{$da->qte_c}}/
                                     {{$da->qte_r}}/
                                     {{substr($da->description,0,30)}} -
                                     {{$da->user}} -
                                     {{$da->po}} -
                                     {{$da->fournisseur}} -
                                     {{$da->arrive}}
                                         <br>
                                 @endforeach
                                    <hr class="emp">
                            @endif

                        </td>


                    </tr>
                @endforeach

                </tbody>

            </table>
            <hr class="emp">

            {{--------MESSAGE AVERTISSEMENT PERTINENCE DONNEES-----------------------------------------------------------------------------------------------------------------}}
            <div class="row hide">
                <div class="column ">
                    <i class="fa fa-warning red"></i>xxxxxxxxxxxxxxxxxx
                </div>
            </div>
            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}
            <br>
        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------------------------------------}}
@stop