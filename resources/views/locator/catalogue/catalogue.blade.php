@extends('templateModule')


@section('t')
    Catalogue
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

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE--------------------------------------------------------------------------------------------------------}}
            <div class="row pad10 hide-for-print">
                <div class="column bgW ">
                    <div class="row align-middle pad5">
                        <div class="column medium-1 fts_150 center ">
                            <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x blue"></i>
                              <i class="fa fa-book fa-stack-1x fa-inverse"></i>
                            </span>

                        </div>
                        <div class="column medium-11 ">
                            <h4 class="googleB">Catalogue</h4>
                            <p>
                                Cette page vous permet d'afficher les différents article du catalogue. <br>
                                Vous pouver filtrer vos la recherche par mot clé.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {!! Form::open(['action' => 'locatorController@postCatalogue', 'method' => 'post']) !!}
            <div class="row">
                <div class="column">
                    @if(session()->has('error_catalogue'))
                        <span class="red b ">{{session()->get('error_catalogue')}}</span>
                    @endif
                </div>
            </div>

            <div class="row ">
                <div class="column medium-10">
                    {!! Form::text('filtre', old('filtre'), ['class' => 'locatorInput']) !!}
                </div>
                <div class="column medium-2">
                    {!! Form::submit('Recherche', ['class' => 'button blue']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <div class="row">
                <div class="column">
                    <h6 class="googleT b ">{!! $msg !!}</h6>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><i class="fa fa-plus"></i></th>
                            <th>Type <br> Marque</th>
                            <th>Model</th>
                            <th>Description</th>
                            <th>Etat du stock</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if( ! empty($articles) )
                        @foreach($articles as $article)
                            <tr>
                                <td class="center"><i class="fa fa-plus "></i></td>
                                <td class="column medium-2 border">
                                    {{$article->art_type}} <br>
                                    {{$article->art_marque}}
                                </td>
                                <td class="column medium-3 border">{{$article->art_model}}</td>
                                <td class="column medium-7 border">{{$article->short_desc}}</td>
                                <td class="column medium-7 border">
                                    @include('locator.catalogue.info')
                                </td>
                            </tr>
                        @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>



            {{--ARTICLE--}}

            {{-----}}
        </div>
        {{--fin MODULE--}}
    </div>
    {{----FIN CONTAINER-----}}
@stop