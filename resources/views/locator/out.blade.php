@extends('templateModule')


@section('t')
    Locator edit
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
            <div class="row bgW">
                <br>
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
            <div class="row align-middle">
                <div class="column medium-1 fts_150" >
                    <a href={{redirect()->back()->getTargetUrl()}}>
                     <span class="fa-stack fa-lg">
                       <i class="fa fa-circle fa-stack-2x blue"></i>
                       <i class="fa fa-angle-double-left fa-stack-1x fa-inverse"></i>
                     </span>
                    </a>
                </div>
                <div class="column medium-10">
                    <span class="fts_180">Sortie du stock de L'ID {{$locator->id->id_locator}}</span>
                </div>
            </div>
            <hr>

            {!! Form::open(['action' => 'locatorController@applyOutId', 'method' => 'post']) !!}
            {{ csrf_field() }}
            {!! Form::hidden('id', $locator->id->id_locator, ['id' => 'id']) !!}

            <div class="row">
                <div class="column medium-6">

                    <label>
                        Commande :
                        @if(session()->has('empty_cmd'))
                            <span class="red">{{session()->get('empty_cmd')}}</span>
                        @elseif(session()->has('not_num'))
                            <span class="red">{{session()->get('not_num')}}</span>
                        @elseif(session()->has('too_short'))
                            <span class="red">{{session()->get('too_short')}}</span>
                        @else
                        @endif

                        {!! Form::text('cmd', old('cmd'), ['class' => 'locatorInput']) !!}
                    </label>
                </div>

                <div class="column medium-6">
                    <label >
                        Numero de serie
                        {!! Form::text('num_serie', old('num_serie')?old('num_serie') :$locator->id->num_serie, ['class' => 'locatorInput']) !!}
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="column right">
                    {!! Form::submit('Sortir', ['class' => 'button blue']) !!}
                </div>
            </div>

            {!! Form::close() !!}
            <hr>



            <div class="row padr10 padl10 ">
                <div class="column">
                    @if(isset($locator->id))
                        <?php $article = $locator->id ?>
                        @if($article->out_datetime == null)
                            @include('locator.article.exist')
                        @else
                            @include('locator.article.out')
                        @endif
                    @endif
                </div>

            </div>
            {{------------}}

            <br>

        </div>
        {{--fin MODULE--}}
    </div>
    {{----FIN CONTAINER-----}}
@stop