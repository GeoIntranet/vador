
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
            <a href="">
                <div class="row padb15 align-middle  googleR bgW">
                    @include('stat.menu.menuSent')
                </div>
            </a>
            {{--FIN MENU GAUCHE -----------------------------------------------------------------------------------------------------------------}}

        </div>
        {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}

        {{--BLOC QUI LE MODULE-----------------------------------------------------------------------------------------------------------------------------------------------}}
        <div class="small-12 medium-12 large-10 column SubContainer">

            {{--BARRE DE RACCOURCIT -----------------------------------------------------------------------------------------------------------------------------------------}}
            <div class="row incRaccourci ">
                <div class="medium-12 column">
                    @include('stat.raccourcit.raccourcitSent')
                </div>
            </div>
            {{---------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE------------------------------------------------------------------------------------------------------------}}
            <div class="row pad10">
                <div class="column medium-12 small-12 large-12 bgW ">
                    <div class="row align-top">
                        {{-- CALENDRIER-------------------------------------------------------------------------------}}
                        <div class="column small-12  medium-5 large-5 center ">
                            <div class="row align-middle pad10">
                                <div class="column left">
                                    <h4 class="googleB"> Calendrier</h4>
                                </div>
                            </div>
                            <div class="row pad10">

                                <div class="column ">

                                    <div class="row align-middle">

                                        <div class="column pad10 left"><a href="{{action('CalenderController@subYear',['controller' => 'CommandSentClassifyController'])}}"><</a></div>
                                        <div class="column pad10 left"><a href="{{action('CalenderController@subMonth',['controller' => 'CommandSentClassifyController'])}}">-</a></div>

                                        <div class="column center pad10">
                                            <b>{{$calender[$dateSent->month]}}</b>
                                        </div>
                                        
                                        <div class="column pad10 right"><a href="{{action('CalenderController@addMonth',['controller' => 'CommandSentClassifyController'])}}">+</a></div>
                                        <div class="column pad10 right"><a href="{{action('CalenderController@addYear',['controller' => 'CommandSentClassifyController'])}}"> >>  </a></div>

                                    </div>
                                    <div class="row borderb padb5">
                                        <div class="column b ">L</div>
                                        <div class="column b ">M</div>
                                        <div class="column b ">M</div>
                                        <div class="column b ">J</div>
                                        <div class="column b ">V</div>
                                        <div class="column b ">S</div>
                                        <div class="column b ">D</div>
                                    </div>
                                    @foreach($calender_ as $kweek => $vweek)
                                        {{--SEMAINE--}}
                                        <div class="row align-middle padt5">
                                            @foreach($vweek as $kday => $vday)
                                                {{--JOUR--}}
                                                <div class="column">
                                                    <div class="row padl10">
                                                        <div class="">
                                                            @if($vday <> '-')
                                                                <?php $dt = new Carbon\Carbon($vday) ?>
                                                                <?php $link = action('CalenderController@selectDt',['controller' => 'CommandSentClassifyController','dt' => $dt->copy()->format('Y-m-d')]) ?>

                                                                @if($dt->copy()->format('Y-m-d') == $now->copy()->format('Y-m-d'))
                                                                    @if($dt->day < 10)
                                                                            <a href="{{$link}}"> <span class="puce_calender success today">0{{$dt->day}}</span> </a>
                                                                    @else
                                                                        <a href="{{$link}}"> <span class="puce_calender success today">{{$dt->day}}</span> </a>
                                                                    @endif
                                                                @elseif($dt->copy()->format('Y-m-d') == $dateSent->copy()->format('Y-m-d'))
                                                                        @if($dt->day < 10)
                                                                            <a href="{{$link}}"><span class="puce_calender warning">0{{$dt->day}}</span></a>
                                                                        @else
                                                                            <a href="{{$link}}"><span class="puce_calender warning">{{$dt->day}}</span></a>
                                                                        @endif
                                                                @else
                                                                    @if($dt->day < 10)
                                                                        <a href="{{$link}}"><span class="puce_calender ">0{{$dt->day}}</span></a>
                                                                    @else
                                                                        <a href="{{$link}}"><span class="puce_calender ">{{$dt->day}}</span></a>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                &nbsp
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--FIN JOUR --}}
                                            @endforeach
                                        </div>
                                        {{--FIN SEMAINE--}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- FIN CALENDRIER---------------------------------------------------------------------------}}

                        {{--MSG INFORMATIF----------------------------------------------------------------------------}}
                        <div class="column small-12 medium-7 large-7">
                            <div class="row align-middle pad5 ">
                                <div class="column medium-12">
                                    <h4 class="googleB">Envoies</h4>
                                    <?php  new Carbon\Carbon($dateSent)?>
                                    <h5>En date du <u>{{$dateSent->format('d-m-Y')}}</u></h5>
                                </div>
                            </div>

                            <div class="row align-middle pad5 ">

                                <div class="column small-2 medium-2 fts_150 center ">
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-circle fa-stack-2x green"></i>
                                      <i class="fa fa-folder fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>

                                <div class="column small-10 medium-10 ">
                                    <p>
                                        Cette section a pour but de visualiser les fiches qui sont integrer et utilisable pour les statisiques des différents envoie qui ont eu lieu. Chaque fiche a une ou plusieurs catégorie / prestations , qui sont utilisables pour filtrer les recherche futur
                                    </p>
                                </div>

                            </div>

                            <div class="row align-middle pad5 ">

                                <div class="column medium-2 fts_150 center ">
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-circle fa-stack-2x green"></i>
                                      <i class="fa fa-percent fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>

                                <div class="column  ">
                                    <p>Nombre d'envoie</p>
                                    @if($countCommand == 0)
                                        <div class="stat"> - </div>

                                    @else
                                        <div class="stat">{{$countCommand}}</div>
                                    @endif

                                </div>
                                <div class="column  ">
                                    @if( $blMAx == null)
                                        <span>Meilleur vente </span>
                                        <div class="stat">-</div>
                                    @else
                                        <span>Meilleur vente <span class="googleT"> ({{$blMAx}})</span> </span>
                                        <div class="stat">{{$priceMax}}e</div>
                                    @endif

                                </div>

                            </div>

                        </div>
                        {{--FIN MSG INFORMATIF------------------------------------------------------------------------}}
                    </div>
                </div>
            </div>

            {{----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <hr class="emp">
            {{--------Tableau fiche Expedié-----------------------------------------------------------------------------------------------------------------------------------}}
            @if( ! empty($commandes))
                <div class="row align-middle">
                    <div class="column small-2 medium-1 center ">
                        <a href="{{route('integerDay',['date'=>$dateSent->format('d-m-Y')])}}"><i class="fa fa-plus-circle"></i></a>
                        <a href="{{route('deleteInteger',['order'=>'day','dt'=>$dateSent->format('d-m-Y')])}}"><i class="fa fa-trash"></i></a>
                    </div>

                    <div class="column small-10 medium-10 left">
                        <h4 class="googleB">Classification</h4>
                    </div>
                </div>

                <div class="row fts_080">
                    <div class="column">
                        <table>
                        <thead>
                        <tr>
                            <th class="center"><i class="fa fa-hashtag"></i></th>
                            <th class="left"> Commande</th>
                            <th class="left"> Client</th>
                            <th class="left"> Vendeur</th>
                            <th class="center">Etat</th>
                            <th class="center"><i class="fa fa-gear"></i></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i=1 ?>
                        @foreach($commandes as $commande)
                            <?php
                                $idVendeur = $commande['id_vendeur'];
                                $client = $commande['id_clientlivr'];
                                $clientName = isset($clients[$client]) ? $clients[$client] : '-' ;
                                $bl = $commande['id_cmd'];

                            ?>
                            <tr>
                                <td class="center">{{$i++}}</td>
                                <td class="left"><a href="{{route('showBlInteger',['bl' => $bl,'l' =>0])}}">{{$bl}}</a></td>
                                <td class="left"> {{$clientName}}</td>
                                <td class="left">
                                    @if(isset($user[$idVendeur]))
                                        {{$user[$idVendeur]['prenom']}} {{$user[$idVendeur]['nom']}}
                                    @else
                                    Utilisateur non-actif ( {{$idVendeur}} )
                                    @endif

                                </td>
                                <td class="center">
                                    @if(isset($integrate[$bl]))
                                        <i class="fa fa-check-circle green"></i>
                                    @else
                                        <i class="fa fa-times-circle red "></i>
                                    @endif

                                </td>
                                <td class="center">

                                    @if(isset($integrate[$bl]))
                                        <a href="{{action('CommandSentClassifyController@destroyBl',['bl' => $bl])}}  ">
                                            <i class="fa fa-trash "></i>
                                        </a>
                                        {{--{!! Form::open(['action' => ['CommandSentClassifyController@destroy',$bl], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
                                        {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit', 'class' => ''))}}
                                        {!! Form::close() !!}--}}

                                    @else
                                        <a href="{{action('CommandSentClassifyController@LogicExecutionOnBl',['bl' => $bl])}}  ">
                                            <i class="fa fa-plus "></i>
                                        </a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            @else
                <div class="row align-middle ">
                    <div class="column large-1 medium-1 "><i class="fa fa-ban fa-3x"></i></div>
                    <div class="column large-10 medium-5 "> <h3>Aucun envoie ce jour. </h3></div>
                </div>
            @endif

            {{-----------------------------------------------------------------------------------------------------------------------------------------------------------------}}

            <br>
        </div>
        {{--BLOC QUI LE MODULE-------------------------------------------------------------------------------------------------------------------------------------------------}}
    </div>
    {{----FIN CONTAINER--------------------------------------------------------------------------------------------------------------------------------------------------------}}
@stop