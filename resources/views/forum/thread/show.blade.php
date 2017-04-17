@extends('templateModule')


@section('t')
    Forum
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
            @include('forum.title')


            {{-- FIN TITRE colorer-------------------------------------------------------------------------------------------------------------}}

            {{--debut MENU GAUCHE ---------------}}
            @include('forum.menu.menu')
            {{--FIN MENU GAUCHE ----------------------}}
        </div>
        {{---------------------------}}

        {{--BLOC QUI LE MODULE-------------}}
        <div class="small-12 medium-10 large-10 column SubContainer ">

            {{--BARRE DE RACCOURCIT ---------------}}
            <div class="row locatorRaccourci ">
                <div class="medium-12 column">
                    @include('forum.raccourcit.raccourcit')
                </div>
            </div>
            <br>
            {{------------}}

            {{--RESUME EXPLICATIF DES DONNEES AFFICHER SUR LA PAGE--------------------------------------------------------------------------------------------------------}}
                @include('forum.presentation')
            {{----------------------------------------------------------------------------------------------------------------------------------------------------------}}

            {!! Form::open(['action' => 'locatorController@postCatalogue', 'method' => 'post']) !!}
            <div class="row">
                <div class="column">
                    @if(session()->has('error_xx'))
                        <span class="red b ">{{session()->get('error_xx')}}</span>
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

            <div class="row align-middle ">
                <div class="column medium-10">
                    <div class="row">
                        <div class="column">
                            <h3>

                                    {{$thread->title}}
                            </h3>
                        </div>
                    </div>
                    <div class="row fts_075">
                        <div class="column">
                            par {{userName($thread->createur->USER_id,'noID')}} le {{$thread->created_at->format('d-m-Y')}}
                        </div>
                    </div>
                </div>
                @if( $thread->createur->USER_id == Auth::id() or $admin  == Auth::id() )
                    <div class="column medium-1 right ">
                        <a href="{{action('ThreadController@edit',[$thread->channel_id ,$thread->id])}}">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x dark"></i>
                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </div>
                    <div class="column medium-1 left ">
                        <a href="{{action('ThreadController@disableThread',[$thread->channel_id,$thread->id])}}">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x red"></i>
                                <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </div>
                @endif

            </div>

            <br>
            <div class="row padl10">
                <div class="column ">
                    {!! $thread->body !!}
                </div>
            </div>

            <hr class="emp">

            @if(session()->get('forum_edit_thread') == TRUE)
                {!! Form::open(['action' => ['RepliesController@store',$thread->channel_id,$thread->id], 'method' => 'post']) !!}

                <div class="row ">
                    <div class="column">
                        {!! Form::textarea('body', '', ['id'=> 'editor',"rows"=>"3",'class' => 'form-control']) !!}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="column right">
                        {!! Form::submit('Répondre', ['class' => "button $color"]) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            @endif


            @if($replies->count() <> 0 )
                <br>
                <div class="row">
                    <div class="column">
                        <h6 class="googleT b ">REPONSES</h6>
                    </div>
                </div>

                @foreach($replies as $reply)
                    <div class="row  pad10 align-middle borderb">
                        <div class="column large-10 medium-10">
                            <div class="row   ">
                                <div class="column fts_080">
                                    par {{userName($reply->owner->USER_id,'noID')}} - {{$reply->created_at->diffForHumans()}}
                                </div>
                            </div>
                            <div class="row  padb5">
                                <div class="column">
                                    {!! $reply->body !!}
                                </div>
                            </div>
                        </div>
                        <div class="column large-2 medium-2">
                            <div class="row  ">
                                <div class="column right">
                                    <a href="{{action('RepliesController@disableReply',[$reply->id])}}"><i class="fa fa-times "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach
                <br>
                @else
                <br>
                @endif


        </div>

        {{--fin MODULE--}}


    </div>
    {{----FIN CONTAINER-----}}
@stop