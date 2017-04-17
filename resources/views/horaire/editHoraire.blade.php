
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
                         <h2 class="googleB"> <i class="fa fa-info-circle"></i> AIDE</h2>
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

                    <p>  Lorsque vous rentre vos horaires, vous avez plusieurs possibilités. </p>
                    <ul class="c">
                        <li>

                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Ce ne sont pas des heures qui vous sont payé. Mais que vous devez RÉCUPÉRER">
                                 <span class="b emp">Récupération</span> :
                            </span>
                            Pour la bonne validation du formulaire, vous devez <abbr>préciser</abbr> la raison qui vous a pousser a faire +/- d'heures.
                        </li>
                        <br/>

                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" Heures payées en plus de votre salaire. ">
                                 <span class="b emp">Heures payées</span> :
                            </span>
                            Vous devez justifier les heures que vous avez travaillé en plus.
                        </li>
                        <br/>
                        <li>
                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" Heures déduites de votre salaire.">
                                 <span class="b emp">Heures NON - payées</span> :
                            </span>
                            indiqué la raison de l'absence.
                        </li>
                        <br/>
                        <li>

                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Est-ce vraiment bien nécéssaire de décrire cette préstation ?!">
                                  <span class="b emp">Congè payé </span>:
                            </span>
                            aucune actions supplémentaires requises.

                        </li>
                        <br/>
                        <li>

                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Est-ce vraiment bien nécéssaire de décrire cette préstation ?!">
                                  <span class="b emp">1/2 Congè payé </span>:
                            </span>
                            il est impératif de rentrer <b>4h</b> dans les heures travaillées, aucun commentaire requis.
                        </li>
                        <br/>
                        <li>

                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Vous avez le droit a un nombre de jour / ans defini par la convention collective, qui vous sont offert">
                                  <span class="b emp">Enfant malade</span>:
                            </span>

                            aucune actions supplémentaires requises.
                        </li>
                    </ul>

                    <br/>

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
                <div class="row">
                    <div class="medium-12 column">
                        <h2 class="googleB"> <i class="fa fa-clock-o"></i> HORAIRE </h2>
                    </div>
                </div>
               <div class="row">
                   <div class="medium-12 column" >
                       <h3>
                           <i class="fa fa-angle-right dk"></i> Edit du
                           <span class="emp">
                               {{$dNext['jour']}} {{$dNext['num_j']}} {{$dNext['mois']}}
                           </span>
                           , vous deviez travaillé <b class="red"><u>{{$htaff}}</u></b>.
                       </h3>
                   </div>
               </div>
                    <hr/>

                    <?php $dt ='2016-03-29' ?>
                    @if(Session::has('ClassWarningC')) <?php $warningC = "warning";?>
                    @else <?php $warningC = '';?> @endif

                    @if(Session::has('ClassWarningM')) <?php $warningM = "warning";?>
                    @else <?php $warningM = '';?> @endif

                    {!! Form::open( [ 'action' => array('HoraireController@update', $h->id), 'method' => 'PUT']) !!}
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    {{ Form::hidden('ht',$htaff) }}
                    {{ Form::hidden('dtr',$next->format('Y-m-d')) }}

                    <div class="row">

                        <div class="medium-3 column">
                            <h5 class="googleB">Heures travaillé</h5>
                        </div>

                        <div class="medium-9 column left">
                                <ul class="c red">
                                    @if( Session::has('hToHigh')) <li> {!! Session::get('hToHigh')!!}</li> @endif
                                    @if( Session::has('noMsg')) <li> {!! Session::get('noMsg')!!}</li> @endif
                                    @if( Session::has('errorPresta')) <li> {!! Session::get('errorPresta')!!}</li> @endif
                                    @if( Session::has('tooPresta')) <li> {!! Session::get('tooPresta')!!}</li> @endif
                                    @if( Session::has('noPresta')) <li> {!! Session::get('noPresta')!!}</li> @endif
                                    @if( Session::has('errorHeure')) <li> {!! Session::get('errorHeure')!!}</li> @endif
                                    @if( Session::has('lowHeure')) <li> {!! Session::get('lowHeure')!!}</li> @endif
                                </ul>
                        </div>

                    </div>

                    <div class="row ">
                        <div class="medium-3 columns ">
                          <label> Heures
                            <input class="horaireInput" type="number" name='heure' placeholder="8" value="{{ old('heure') }}"  min="0" max="24" autofocus>
                          </label>
                        </div>

                        <div class="medium-3 columns">
                          <label> Minutes
                            <input class="horaireInput {{$warningM}}" type="number" name='minute' placeholder="00" value="{{old('minute')}}"  min="0" max="60" >
                          </label>
                        </div>

                        <div class="medium-6 columns">
                            <label>Commentaire
                              {{ Form::text('commentaire', '', ['class' => 'horaireInput '.$warningC.'','placeholder' => '']) }}
                            </label>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="medium-12 column">
                            <h5 class="googleB">Prestations</h5>
                        </div>
                    </div>
                    @foreach ($presta->chunk(3) as $presta_)
                        <div class="row">
                            @foreach ($presta_ as $kpre => $vpre )
                                @if($kpre == 'hnp')
                                    <div class="medium-4 column">
                                        <input type="radio" name="presta" value="hpn" id="hpn" <?php if(Input::old('presta')== "hpn") { echo 'checked="checked"'; } ?> >
                                        <label for="hpn">Heures <u>NON</u>-payées</label>
                                    </div>
                                @elseif($kpre == 'n')
                                <div class="medium-4 column">
                                    <input type="radio" name="presta" value="{{$kpre}}" id="{{$kpre}}" checked  >
                                    <label for="{{$kpre}}">Horaire normal</label>
                                </div>
                                @else
                                    <div class="medium-4 column">
                                        <input type="radio" name="presta" value="{{$kpre}}" id="{{$kpre}}" <?php if(Input::old('presta')== $kpre) { echo 'checked="checked"'; } ?> >
                                         <label for="{{$kpre}}">{{$vpre}}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach



                    <hr/>
                    <div class="row ">

                        <div class="medium-12 column right">
                        <br/>
                        <br/>
                            {!! Form::submit('Valider', ['class' => 'button alert']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>

    </div>
    {{------------------------------------------------------------------------------------------------------------}}

</div>

<div class="row">

           <div class="large-2 small-12 medium-2 column left">
               <button class="linkPrev">
                    <a href={{route('horaire.index')}}>
                        <span class="InlineBlock ico"><i class="fa fa-chevron-left"></i></span>
                        <span class="InlineBlock googleB">Retour </span>
                    </a>
               </button>
           </div>
      </div>



    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
@stop


