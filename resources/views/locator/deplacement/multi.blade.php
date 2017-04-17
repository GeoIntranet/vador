@extends('templateModule')


@section('t')
    Locator sortie
@stop


@section('menu')
    @locatorlude('menu.navbars')
@stop

@section('content')

    <br/>
    {{--CONTAINER----------------------------------------------------------------------------------------------------------------------------}}
    <div class="row locatorContainer pad5 ">

        {{--BLOC QUI CONTIENT LE MENU + TITRE COLORER -----------------------------------------------------------------------------------------}}
        <div class="medium-2 large-2  column  show-for-large  statutBar">
            {{--TITRE colorer -----------------------------------------------------------------------------------------------------------------}}
            <div class="row locatorRaccourci align-middle ">
                <div class="columns left "> Locator</div>
                <div class="columns left"><i class="fa fa-area-chart white "></i></div>
            </div>

            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE ---------------}}
            @include('locator.menu.menu')
            {{--FIN MENU GAUCHE ----------------------}}
        </div>
        {{---------------------------}}

        {{--BLOC QUI LE MODULE-------------}}
        <div class="small-12 medium-10 large-10 column SubContainer ">

            {{--BARRE DE RACCOURCIT ---------------}}
            <div class="row locatorRaccourci ">
                <div class="medium-12 column">
                    @include('locator.raccourcit.raccourcit')
                </div>
            </div>
            <br>
            {{------------}}
            {!! Form::open(['action' => 'locatorController@postMultiId', 'method' => 'post']) !!}
            <div class="row">
                <div class="column">
                    @if(session()->has('errorMulti'))
                        <span class="red b ">{{session()->get('errorMulti')}}</span>
                    @endif
                </div>
            </div>

            <div class="row ">
                <div class="column medium-10">
                    <?php $id =  session()->get('dataMultiple')[0].'.'.count(session()->get('dataMultiple')) ; ?>
                    {!! Form::text('multi', $id, ['class' => 'locatorInput']) !!}
                </div>
                <div class="column medium-2">
                    {!! Form::submit('Recherche', ['class' => 'button blue']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE--------------------------------------------------------------------------------------------------------}}
            <div class="row pad10 hide-for-print">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x blue"></i>
                              <i class="fa fa-info fa-stack-1x fa-inverse"></i>
                            </span>

                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">Déplacement multi ID</h4>
                            <p>
                                Cette page permet de déplacer les ID selectionés précédements.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {!! Form::open(['action' => 'locatorController@postMultiDeplacement', 'method' => 'post']) !!}
            @if(session()->has('error_cmd'))
                <div class="row">
                    <div class="column b red">
                        {{session()->get('error_cmd')}}
                    </div>
                </div>
            @endif
            <div class="row align-middle pad10">
                <div class="column">
                    <label for="">
                       <i class="fa fa-table"></i> Emplacement
                        <select name="emp" >
                            @foreach($emps as $index_emp => $emp)
                                <option value="{{$emp}}">{{$emp}}</option>
                            @endforeach
                        </select>

                    </label>

                </div>
                <div class="column">
                    {!! Form::submit('Deplacer', ['class' => 'button blue']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            <hr class="emp locator">
            @if(session()->has('success_out'))
                <div class=" sms mSucess">
                    {!! Session::get('success_out') !!}
                </div>
            @endif
            <br>
            {{--ARTICLE--}}
            @include('locator.article.article')
            {{-----}}
        </div>
        {{--fin MODULE--}}
    </div>
    {{----FIN CONTAINER-----}}
@stop