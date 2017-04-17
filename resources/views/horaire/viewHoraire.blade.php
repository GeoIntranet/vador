
@extends('templateModule')


@section('t')
    Horaires
@stop





@section('menu')
          @include('menu.navbars')
@stop





@section('content')
<br/>

<?php
//var_dump(old('heure'));
//var_dump(old('minute'));
//var_dump(old('presta'));
?>
<br/>
<div class="row">

    {{--AFFICHAGES DES ERREURES-----------------------------------------------------------------------------------}}
        <div class="medium-12 column">
             @include('flash.flash')
        </div>
    {{------------------------------------------------------------------------------------------------------------}}

    {{--AFFICHAGES BULLE AIDES-----------------------------------------------------------------------------------}}
    <div class="show-for-medium small-12 medium-12 large-4 column ">

        <div class="row padr10">
            <div class="medium-12  column  mContainer ">

                <div class="row ">
                    <div class="medium-12 column ">
                         <h2 class="googleB"> <i class="fa fa-info-circle"></i> AIDE&</h2>
                    </div>
                </div>
                <div class="row hide">
                    <div class="medium-12 column ">
                       <h5 class="googleT">
                            <i class="fa fa-paperclip"></i> Les horaires pour les
                            <span class="emp b ">NULS</span>
                       </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 column fts_090">

                    <p>  Résumé des différents  <abbr >logos</abbr> et  <abbr >couleurs</abbr> . </p>
                    <h5 class="googleB"> Couleurs</h5>
                    <ul class="c">
                        <li>

                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="">
                                 <span class="b emp">Gris</span> :
                            </span>
                           Les cases de cette couleur signifient que vous avez fait le nombres d'heures <abbr> prévu</abbr> ce jours la.
                        </li>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="">
                                 <span class="b emp">Rouge</span> :
                            </span>
                            Signifie que vous avez fait plus ou moins d'heure que la normale , que vous avez été peut être absent .
                        </li>
                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="">
                                 <span class="b emp">Vert</span> :
                            </span>
                           Représente les jours de week-end
                        </li>
                        <br/>
                    </ul>
                   <h5 class="googleB"> Logo</h5>

                    <ul class="c">
                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Vous avez choisit congé payé comme prestation">
                                  <span class="b emp">CP </span>:
                            </span>
                            Congés payé
                        </li>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Vous avez choisit demie congé payé comme prestation">
                                  <span class="b emp">CP/2</span>:
                            </span>
                            Un demie congés payé
                        </li>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Vous avez choisit enfant malade comme prestation">
                                  <span class="b emp">EF</span>:
                            </span>
                            Enfant malade
                        </li>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Vous avez choisit récupération comme prestation">
                                  <span class="b emp">R</span>:
                            </span>
                            Récupération
                        </li>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Vous avez choisit heures payées comme prestation">
                                  <span class="b emp">HP</span>:
                            </span>
                            Heures payées
                        </li>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Vous avez choisit heures NON payées comme prestation">
                                  <span class="b emp">HNP</span>:
                            </span>
                            Heures NON payées
                        </li>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Est-ce vraiment bien nécéssaire de décrire cette préstation ?!">
                                  <span class="b emp">F</span>:
                            </span>
                            Férié
                        </li>

                    </ul>

                    <br/>
                    <h5 class="googleB"> Edition</h5>
                    <ul class="c">
                        <li>

                            <p>Vous pouvez éditer vos horaires à tout moment en cas d'erreur. Il vous suffit simplement de cliquer sur la case corréspondante.</p>

                        </li>
                    </ul>

                    </div>
                </div>




            </div>
        </div>

    </div>
    {{------------------------------------------------------------------------------------------------------------}}

    {{--AFFICHAGES FORMULAIRE HORAIRES----------------------------------------------------------------------------}}
    <div class="small-12 medium-12  large-8 column mContainer">

        <div class="row align-">
            <div class="medium-12 column">
                   <h1 class="googleB"> <i class="fa fa-clock-o"></i> Récapitulatif horaires</h1>
            </div>
        </div>
        <hr/>
        <div class="row">
        <?php
            $dts_ = $g->decompose($dts);
            $dte_ = $g->decompose($dte);
         ?>
        </div>
        <div class="row align-">
            <div class="medium-12 column">

                <div class="row padb10">
                    <div class="medium-12 column"> Du
                        {{$dts_['jour']}} {{$dts_['num_j']}} {{$dts_['mois']}} au
                        {{$dte_['jour']}} {{$dte_['num_j']}} {{$dte_['mois']}}
                    </div>
                </div>

                <hr class="pt sm"/>

                <div class="row padb10 fts_080">
                    <div class=" left column medium-3"> <span class="b">Récupération :</span> @if(isset($solde)) {{$hg->mh($solde->CUMULE_rec_solde)}}  @else - @endif </div>
                    <div class=" left column medium-3"> <span class="b">Congés-payés :</span> @if(isset($solde)) {{$solde->CUMULE_cp_solde}} j  @else - @endif</div>
                    <div class=" left column medium-3"> <span class="b">Heures payées :</span> @if(isset($solde)) {{$hg->mh($solde->CUMULE_hp_solde)}}  @else - @endif</div>
                    <div class=" left column medium-3"> <span class="b">Heures NON-payées :</span> @if(isset($solde)) {{$hg->mh($solde->CUMULE_hnp_solde)}}  @else - @endif</div>
                </div>
                <hr class="pt sm"/>

                <br/>

                <div class="row pad2">
                    <div class="column">&nbsp</div>
                    <div class="center column medium-2 googleB">Lundi</div>
                    <div class="center column medium-2 googleB">Mardi</div>
                    <div class="center column medium-2 googleB">Mercredi</div>
                    <div class="center column medium-2 googleB">Jeudi</div>
                    <div class="center column medium-2 googleB">Vendredi</div>
                    <div class="center column">&nbsp</div>
                    <div class="center column">&nbsp</div>
                </div>

                <?php $i=0; ?>

                @foreach($h as $chunk)
                @if($i <> $diffW)
                    <div class="row pad2">
                        <div class="column">
                              <span class="googleB">{{$i++}}</span>
                        </div>
                       @foreach($chunk as $k => $v)
                            @if($v['interval'] == TRUE)

                                @if($v['normalState'] == TRUE)

                                    @if($v['com'] == "FERRIER")

                                        <?php
                                            $dt = new \Carbon\Carbon($v['dt']);
                                            $c = 'Le '.$dt->format('d - m') .' ----------------- '.' Fèrié ! ' ;
                                        ?>

                                        <div class="has-tip[tip-top] has-tip top medium-2 column normal hModule " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">
                                            <a class="" href="{{route('horaire.edit',['id' =>$v['id'] ])}}">
                                                <div class="row">
                                                    <div class="medium-12 column left">
                                                        <span class="F">Fe</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @else

                                        <?php
                                            $dt = new \Carbon\Carbon($v['dt']);
                                            $c = 'Le '.$dt->format('d - m') .' ----------------- '.' Horaire normal ' ;
                                        ?>

                                        <div class="has-tip[tip-top] has-tip top medium-2 column normal hModule " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">

                                            <a class="" href="{{route('horaire.edit',['id' =>$v['id'] ])}}">
                                                {{substr($v['h'],0,5)}}
                                            </a>
                                        </div>
                                    @endif
                                @else

                                <?php
                                $dt = new \Carbon\Carbon($v['dt']);

                                if($v['cp'] == 1) $presta = 'Congé payé';
                                elseif($v['cp2'] == 1) $presta = 'Demie Congé payé ';
                                elseif($v['ef'] == 1) $presta = 'Enfant malade  ';
                                elseif($v['rec'] == 1) $presta = 'Récupération -';
                                elseif($v['hp'] == 1) $presta = 'Heures payées -';
                                elseif($v['hnp'] == 1) $presta = 'Heures non-payées - ';
                                else{
                                    $presta = ' ';
                                }


                                $c = 'Le '.$dt->format('d - m') .' ----------------- '.
                                $presta.'  '.$v['com']
                                ;
                                 ?>

                                <div class="has-tip[tip-top] has-tip top medium-2 column anormal hModule" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">
                                    <a class=" " href="{{route('horaire.edit',['id' =>$v['id'] ])}}">
                                        <div class="row">
                                            @if($v['cp'] == 1)
                                                <div class="medium-4 column "> <span class="CP">CP</span></div>  <div class="medium-8 column center">   </div>
                                            @elseif($v['cp2'] == 1)
                                                <div class="medium-4 column "> <span class="CP">CP/2</span></div>  <div class="medium-8 column center">   </div>
                                            @elseif($v['ef'] == 1)
                                                 <div class="medium-4 column "> <span class="CP">EF</span></div>  <div class="medium-8 column center">   </div>
                                            @elseif($v['rec'] == 1)
                                                <div class="medium-4 column "><span class="REC">R</span></div>   <div class="medium-8 column center red b">  {{substr($v['h'],0,5)}}</div>
                                            @elseif($v['hp'] == 1)
                                                  <div class="medium-4 column "><span class="HP">HP</span></div> <div class="medium-8 column center">  {{substr($v['h'],0,5)}}</div>
                                            @elseif($v['hnp'] == 1)
                                                  <div class="medium-4 column "><span class="HNP">HNP</span> </div>
                                                  <div class="medium-8 column center">
                                                        @if(substr($v['h'],0,2) == '00') @else  {{substr($v['h'],0,5)}} @endif
                                                  </div>

                                            @else
                                                 <div class="medium-4 column "></div> <div class="medium-8 column center">  {{substr($v['h'],0,5)}}</div>
                                            @endif
                                        </div>
                                    </a>
                                </div>

                                @endif

                            @else
                                <div class="medium-2 column center">
                                  &nbsp
                                </div>
                            @endif


                       @endforeach
                           <div class=" column hModule weekEnd">S</div>
                           <div class=" column hModule weekEnd">D</div>
                    </div>
                @endif
                @endforeach

                <?php //var_dump($h->chunk(5)); ?>

            </div>
        </div>
            <br/>
            <br/>
            <br/>
        <div class="row">
            <div class="medium-7 column"></div>
            <a class="medium-4 column  center googleB mSave" href="{{action('HoraireAdmController@getAbs')}}">Demande d'absence</a>
        </div>

    </div>
    {{------------------------------------------------------------------------------------------------------------}}

</div>


<div class="row">
    <div class="medium-12">
        <i class="fa fa-lock"></i> &nbsp <a class="b red" href="{{action('Auth\AuthController@logout')}}">Déconnexion</a>
    </div>
</div>













{{--@if (isset($errors->all()['com']))--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--<li>($errors->com</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}


    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
@stop


