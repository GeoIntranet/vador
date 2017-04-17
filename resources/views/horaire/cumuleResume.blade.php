
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
<div class="row expanded margin10">

    {{--AFFICHAGES DES ERREURES-----------------------------------------------------------------------------------}}
        <div class="medium-12 column">
             @include('flash.flash')
        </div>
    {{------------------------------------------------------------------------------------------------------------}}

    <?php
        $val = '4';
        if(isset($input['s'])){
            if($input['s'] <> ''){
             $val = $input['s'];
            }
        }
    ?>
    {{--AFFICHAGES FORMULAIRE HORAIRES----------------------------------------------------------------------------}}
    <div class="small-12 medium-12  large-12 column mContainer ">

        <div class="row expanded pad5">
            <div class="medium-12 column">

                    <?php $saCheck = (isset($input['SA']) AND ($input['SA'] == 1)) ? TRUE : FALSE; ?>

                <div class="row hide-for-print expanded">

                    <div class="medium-4 column ">
                        <h2 class="googleB"> <i class="fa fa-clock-o"></i> Resumé horaire <a href="{{action('HoraireAdmController@QuePassaPDF')}}"><i class="fa fa-file-pdf-o"></i></a></h2>
                    </div>

                    <div class="medium-8 column  ">
                        {!! Form::open( [ 'action' => array('HoraireAdmController@QuePassa'), 'method' => 'POST']) !!}
                        <div class="row align-middle expanded hide-for-print right">

                            <div class="medium-offset-5 medium-3 column right">
                              <label class="left" > Nombres de semaine visualiser
                                <input class="" type="number" name='s' placeholder="" value="{{$val}}"  min="1" max="7" autofocus>
                              </label>
                            </div>

                            <div class="medium-2 column center">

                                <label>Semaine anticiper
                                 {{ Form::checkbox( 'SA', true,$saCheck)}}

                                </label>
                            </div>
                            <div class="medium-2 column right">
                                {!! Form::submit('Valider', ['class' => ' button alert']) !!}
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>







                    <div class="row  expanded resume">
                            <div class="column">&nbsp</div>

                        @foreach($base as $semaine => $v)
                            <div class="column semaine">
                                <div class="row center">
                                    <div class="column subCatHead">
                                    <?php
                                    $dt = new \Carbon\Carbon($semaine);
                                    $dt = $dt->copy()->weekOfYear;
                                    ?>
                                    Semaine {{$dt}}
                                    </div>
                                </div>
                                <div class="row googleB">
                                    <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">R</div>
                                    <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">HP</div>
                                    <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">NP</div>
                                    <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">CP</div>
                                    <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">EF</div>

                                </div>

                            </div>
                        @endforeach

                        <div class="column semaine">
                            <div class="row center">
                                <div class="column subCatHead googleB"> SOLDE</div>
                            </div>
                            <div class="row googleB">
                                <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">R</div>
                                <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">HP</div>
                                <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">NP</div>
                                <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">CP</div>
                                <div class="center padb3 padt3 padr0 padl0 column subCatHead weekEnd">EF</div>
                            </div>
                        </div>

                    </div>



                    @foreach($r as $kr => $vr)
                     <div class="row expanded fts_080 resume ">
                        <div class="column user">
                            {{$u[$kr]->USER_nom}} ( {{$u[$kr]->USER_id}} )
                        </div>
                        @foreach($base as $se => $vse)
                            <div class="column center semaine">
                            @if(isset($r[$kr][$se]))
                                <div class="row expanded">

                                    @if(  $r[$kr][$se]->CUMULE_rec == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        {{$hg->mh($r[$kr][$se]->CUMULE_rec)}}
                                      </div>
                                   @endif

                                    @if(  $r[$kr][$se]->CUMULE_hp == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        {{$hg->mh($r[$kr][$se]->CUMULE_hp)}}
                                      </div>
                                   @endif

                                    @if(  $r[$kr][$se]->CUMULE_hnp == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        {{$hg->mh($r[$kr][$se]->CUMULE_hnp)}}
                                      </div>
                                   @endif

                                    @if(  $r[$kr][$se]->CUMULE_cp == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat OI">
                                        {{$r[$kr][$se]->CUMULE_cp}}
                                      </div>
                                   @endif

                                    @if(  $r[$kr][$se]->CUMULE_ef == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat OI">
                                        {{$r[$kr][$se]->CUMULE_ef}}
                                      </div>
                                   @endif

                                </div>



                            @else
                                <div class="row expanded">
                                    <div class="center padb3 padt3 padr0 padl0 column subCat anormal"> &nbsp </div>

                                </div>
                            @endif


                            </div>
                        @endforeach

                        <div class="column semaine">
                            <div class="row ">

                                    @if(  $solde[$kr]->CUMULE_rec_solde == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        <a href="{{action('HoraireAdmController@getCumuleEdit',['id' =>$solde[$kr]->id ])}}">{{$hg->mh($solde[$kr]->CUMULE_rec_solde)}}</a>
                                      </div>
                                   @endif

                                    @if(   $solde[$kr]->CUMULE_hp_solde == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        <a href="{{action('HoraireAdmController@getCumuleEdit',['id' =>$solde[$kr]->id ])}}">{{$hg->mh($solde[$kr]->CUMULE_hp_solde)}}</a>
                                      </div>
                                   @endif

                                    @if(  $solde[$kr]->CUMULE_hnp_solde == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        <a href="{{action('HoraireAdmController@getCumuleEdit',['id' =>$solde[$kr]->id ])}}">{{$hg->mh($solde[$kr]->CUMULE_hnp_solde)}}</a>
                                      </div>
                                   @endif

                                    @if(  $solde[$kr]->CUMULE_cp_solde == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                           <a href="{{action('HoraireAdmController@getCumuleEdit',['id' =>$solde[$kr]->id ])}}">{{$solde[$kr]->CUMULE_cp_solde}}</a>
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        <a href="{{action('HoraireAdmController@getCumuleEdit',['id' =>$solde[$kr]->id ])}}">{{$solde[$kr]->CUMULE_cp_solde}}</a>
                                      </div>
                                   @endif

                                    @if(  $solde[$kr]->CUMULE_ef_solde == 0)
                                        <div class="center padb3 padt3 padr0 padl0 column subCat normal">
                                          &nbsp
                                        </div>
                                    @else
                                      <div class="center padb3 padt3 padr0 padl0 column subCat anormal">
                                        <a href="{{action('HoraireAdmController@getCumuleEdit',['id' =>$solde[$kr]->id ])}}">{{$solde[$kr]->CUMULE_ef_solde}}</a>
                                      </div>
                                   @endif
                            </div>
                        </div>



                     </div>
                    @endforeach

<br/>


            </div>
        </div>

    </div>
    {{------------------------------------------------------------------------------------------------------------}}

</div>

<div class="row expanded hide-for-print">
     <div class="large-2 small-12 medium-2 column left">
         <button class="linkPrev">
              <a href={{route('gestionHoraire')}}>
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


