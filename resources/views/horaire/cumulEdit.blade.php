
@extends('templateModule')


@section('t')
    Horaires
@stop





@section('menu')
     @include('menu.navbars')
@stop





@section('content')
<br/><br/><br/>
<div class="row ">

    {{--AFFICHAGES DES ERREURES-----------------------------------------------------------------------------------}}
        <div class="medium-12 column">
             @include('flash.flash')
        </div>
    {{------------------------------------------------------------------------------------------------------------}}

    {{--AFFICHAGES FORMULAIRE HORAIRES----------------------------------------------------------------------------}}
    <div class="small-12 medium-12  large-12 column mContainer ">

        <div class="row">
            <div class="medium-12 column"><h3>Modification du solde de <span class="emp">{{$user->USER_nom}} {{$user->USER_prenom}}</span></h3></div>
        </div>

        <hr/>

        <div class="row">
            <div class="medium-12 column"> <h4 class="googleB"><u>Solde</u></h4></div>
        </div>

        <div class="row">

            <div class="left medium-3 column"> Récupération :
                @if($cumule->CUMULE_rec_solde == 0) - @else{{$cumule->CUMULE_rec_solde}} @endif
            </div>

            <div class="left medium-3 column"> Congés-payées :
                @if($cumule->CUMULE_cp_solde == 0) - @else{{$cumule->CUMULE_cp_solde}} @endif
            </div>

            <div class="left medium-3 column"> Heures-payées :
              @if($cumule->CUMULE_hp_solde == 0) - @else{{$cumule->CUMULE_hp_solde}} @endif
            </div>

            <div class="left medium-3 column"> Heures-NON-payées :
              @if($cumule->CUMULE_hnp_solde == 0) - @else{{$cumule->CUMULE_hnp_solde}} @endif
            </div>
        </div>

        <hr class="sm pt"/>
        <br/>

        <div class="row">
            <div class="medium-12 column">
                <h4>Edition</h4>
            </div>
        </div>



        {{ Form::open(['action' => 'HoraireAdmController@postCumuleEdit', 'method' => 'post']) }}
            {{ Form::hidden('id',$cumule->id) }}
            <div class="row">

                <div class="column medium-3">
                    {{ Form::label('rec', 'Récupération', ['class' => 'control-label']) }}
                    {{ Form::text('rec',$hg->mh($cumule->CUMULE_rec_solde), ['class' => 'form-control']) }}
                </div>

                <div class="column medium-3">
                    {{ Form::label('cp', 'Congés-payées', ['class' => 'control-label']) }}
                    {{ Form::text('cp',$cumule->CUMULE_cp_solde, ['class' => 'form-control']) }}
                </div>

                <div class="column medium-3">
                    {{ Form::label('hp', 'Heures-payées', ['class' => 'control-label']) }}
                    {{ Form::text('hp',$hg->mh($cumule->CUMULE_hp_solde), ['class' => 'form-control']) }}
                </div>

                <div class="column medium-3">
                    {{ Form::label('hnp', 'Heures-NON-payées', ['class' => 'control-label']) }}
                    {{ Form::text('hnp',$hg->mh($cumule->CUMULE_hnp_solde), ['class' => 'form-control']) }}
                </div>

            </div>

            <div class="row">
                <div class="medium-12 column right">
                    {{ Form::submit('Valider', ['class' => 'button info']) }}
                </div>
            </div>
            
        {{ Form::close() }}

    </div>
    {{------------------------------------------------------------------------------------------------------------}}

</div>

<div class="row  hide-for-print">
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


