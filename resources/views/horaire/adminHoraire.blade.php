
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
<div class="row expanded margin10 mContainer">



    {{--AFFICHAGES DES ERREURES-----------------------------------------------------------------------------------}}
        <div class="medium-12 column show-for-medium">
             @include('flash.flash')
        </div>
    {{------------------------------------------------------------------------------------------------------------}}

    <div class="moduleMenu show-for-medium ContainerMenu">
        @include('horaire.menu.horaireMenu')
    </div>
    <div class=" column ">

        <div class="row">
            <div class="small-12 medium-12 column">
                <h3 class="googleB">Administration horaire utilisateurs</h3>
            </div>
        </div>


        <div class="row expanded">

            <span class="large-1  medium-1 small-1 center column ">
              &nbsp
            </span>
            @foreach($int as $kint => $vint)
               <?php  $dt1 = new \Carbon\Carbon($vint[0]); ?>
               <?php  $dt2 = new \Carbon\Carbon($vint[1]); ?>

                <span class="column center">
                     {{$dt1->format('d-m')}} &#8212 {{$dt2->format('d-m')}}
                </span>

            @endforeach
        </div>

        <div class="row expanded">
            <span class="large-1  medium-1 small-1  center column ">
              &nbsp
            </span>
           @foreach($calender as $cal)
                @foreach($cal as $k => $v)
                <?php
                    $dt = new \Carbon\Carbon($v['dt']);
                    $c = $dt->format('d-m-Y');
                ?>
                 <span class="has-tip[tip-top] has-tip top  column weekEnd hModule left " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">
                     {{substr($v['d'],0,1)}}
                 </span>
                @endforeach
              <span class="column hModule weekEnd left">W</span>
           @endforeach
        </div>


        @foreach($h as $kh => $vh)
            <div class="row expanded pad3 left">
                <span class="large-1  medium-12 small-12 column ">
                    {{substr($u[$kh]->USER_prenom,0,1)}}.{{ ucfirst(strtolower($u[$kh]->USER_nom))}}
                </span>

                @foreach($vh->chunk(5) as $chunk)
                    @foreach($chunk as $k => $v)
                        @if($v['interval'] == TRUE or $v['a'] == TRUE)
                            @if($v['normalState'] == TRUE)
                                @if($v['RE'] == TRUE AND $v['id'] == FALSE)
                                    <?php
                                        $id = $u[$kh]->USER_id;
                                        $dt = new \Carbon\Carbon($v['dt']);
                                        $dtt = $dt->copy()->format('Y-m-d');
                                        $c = 'Edit DU '.$dt->copy()->format('d-m-Y');
                                    ?>
                                     <a class="column OI hModule"  href="{{route('GEH',['id' => 0, 'user' => $id , 'dt' => $dtt]) }}">
                                        <span class="has-tip[tip-top] has-tip top left"  data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">
                                             x
                                        </span>
                                     </a>

                                @else

                                    @if($v['com'] == "FERRIER")
                                        <?php
                                            $dt = new \Carbon\Carbon($v['dt']);
                                            $c = 'Le '.$dt->format('d - m') .' ----------------- '.' Fèrié ! ' ;
                                        ?>

                                        <span class="has-tip[tip-top] has-tip top  column normal hModule left FF" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">
                                            <a class="" href="{{route('horaire.edit',['id' =>$v['id'] ])}}">
                                                <span class="">&nbsp</span>
                                            </a>
                                        </span>
                                    @else

                                        <?php
                                            $dt = new \Carbon\Carbon($v['dt']);
                                            $c = 'Le '.$dt->format('d - m') .' ----------------- '.' Horaire normal ';
                                        ?>
                                        <a class=" column normal hModule left" href="{{route('GEH',['id' =>$v['id'], 'user' => 0 , 'dt' => 0]) }}">
                                            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">
                                                &nbsp
                                            </span>
                                        </a>
                                    @endif
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
                                    else{  $presta = ' '; }

                                    $c = 'Le '.$dt->format('d - m') .' ----------------- '.
                                    $presta.'  '.$v['com'].
                                    ' ------------ HT : '. substr($v['h'],0,5)
                                    ;
                                 ?>
                                    <a class="column anormal hModule left" href="{{route('GEH',['id' =>$v['id'], 'user' => 0 , 'dt' => 0]) }}">
                                        <span class="has-tip[tip-top] has-tip top  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="{{$c}}">
                                            &nbsp
                                        </span>
                                     </a>
                            @endif
                        @else

                            @if($v['dt'] < $today->format('Y-m-d'))
                                <span class="column NR hModule left"> </span>
                            @else

                            <?php //var_dump($v); ?>
                            <a class="column NR hModule left" href="{{route('GEH',['id' => 0, 'user' => $u[$kh]->USER_id , 'dt' => $v['dt']]) }}">
                                <span class="has-tip[tip-top] has-tip top  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="horaire anticipé">
                                    a
                                </span>
                            </a>
                            @endif
                        @endif
                    @endforeach
                    <span class="column hModule weekEnd left">W</span>
                @endforeach
            </div>
        @endforeach



        <div class="row expanded">
            <span class="large-1  medium-12 small-12  center column ">
               -
            </span>
           @foreach($calender as $cal)
                @foreach($cal as $k => $v)
                    <span class="column hModule weekEnd left">{{substr($v['d'],0,1)}}</span>
                @endforeach
              <span class="column hModule weekEnd left">W</span>
           @endforeach
        </div>
        <br/>
</div>

</div>

    {{------------------------------------------------------------------------------------------------------------}}



<div class="row expanded">

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


