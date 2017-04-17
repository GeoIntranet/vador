
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

    {{------------------------------------------------------------------------------------------------------------}}

    {{--AFFICHAGES FORMULAIRE HORAIRES----------------------------------------------------------------------------}}
    <div class="small-12 medium-12  large-12 column mContainer">

        <div class="row align-">
            <div class="medium-12 column">
                   <h1 class="googleB"> <i class="fa fa-clock-o"></i> Demande d'absence</h1>
            </div>
        </div>
        <hr/>
        <div class="row">

            <div class="medium-12 column">


                    {{ Form::open(['action' => 'HoraireAdmController@postAbs', 'method' => 'post']) }}

                        {{ Form::hidden('remember_token') }}
                        {{ Form::hidden('user',$user) }}

                    <div class="row align-middle">

                        <div class="medium-5 column">

                        {{ Form::label('email', 'Départ le ') }}
                        <input name='dt1' value="{{old('dt1')}}" type="text" class="span2"  id="dpd1">
                            <script>
                            $(function(){
                              $('#dpd1').fdatepicker({
                            		format: 'dd-mm-yyyy hh:ii',
                            		disableDblClickSelection: true,
                            		language: 'fr',
                            		pickTime: true
                            	});
                            });
                            </script>
                        {{ Form::label('email', 'Retour le ') }}
                        <input name='dt2'  value="{{old('dt2')}}" type="text" class="span2"  id="dpd2">
                            <script>
                            $(function(){
                              $('#dpd2').fdatepicker({
                                    format: 'dd-mm-yyyy hh:ii',
                            		disableDblClickSelection: true,
                            		language: 'fr',
                            		pickTime: true
                            	});
                            });
                            </script>
                        </div>
                        <div class="medium-6 column">
                            <div class="row align-middle">
                               <div class="medium-4 column center">
                                   {{ Form::label('presta-0', 'Congé Payées',['class' =>'']) }}
                                   {{ Form::radio('presta', 'cp',false, array('id'=>'presta-0')) }}
                               </div>

                               <div class="medium-4 column center">
                                   {{ Form::label('presta-1', 'NON-payées') }}
                                   {{ Form::radio('presta', 'np',false, array('id'=>'presta-1')) }}
                               </div>

                               <div class="medium-4 column center">
                                   {{ Form::label('presta-2', 'Récuperation') }}
                                    {{ Form::radio('presta', 'recup',false, array('id'=>'presta-2')) }}
                               </div>
                            </div>
                        </div>


                    <br/>


                    </div>
                    <hr/>
                    <div class="row">
                        <div class="medium-12 right column">   {{ Form::submit('Envoyé', ['class' => 'button green']) }}</div>
                    </div>



                    {{ Form::close() }}
                </div>



            </div>




    </div>
    {{------------------------------------------------------------------------------------------------------------}}

</div>

<br/>
<div class="row">
    <div class="medium-12">
        <i class="fa fa-angle-left"></i> &nbsp <a class="b dark" href="{{action('HoraireController@index')}}">Retour</a>
    </div>
</div>
<div class="row">
    <div class="medium-12">
        <i class="fa fa-lock"></i> &nbsp <a class="b red" href="{{action('Auth\AuthController@logout')}}">Déconnexion</a>
    </div>
</div>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>



<br/><br/><br/><br/>
<br/><br/><br/><br/>



@stop


