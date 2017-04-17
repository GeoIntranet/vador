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
                            <h4 class="googleB">Forum</h4>
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

            <div class="row">
                <div class="column">
                    <h3> Edition du sujet : {{$thread->title}}</h3>
                </div>
            </div>
            <div class="row ">

                <div class="column">

                    {!! Form::model($thread,[ 'action'=> ['ThreadController@update',$thread->id],'methode' => 'POST' ])!!}
                    <div class="row">
                        <div class="column">
                            {{ csrf_field() }}
                            {!! Form::hidden('id', $thread->id, ['id' => 'id']) !!}

                            {!!  Form::label('title', 'titre') !!}
                            {!!  Form::text('title',null,['class' => 'locatorInput']) !!}

                        </div>
                        <div class="column">
                            {!!  Form::label('Choose a channel', '') !!}
                            {!!  Form::select('channel_id', $channels_, $thread->channel_id) !!}

                            {{--<label for="channel_id">Choose a Channel:</label>--}}
                            {{--<select name="channel_id" id="channel_id" class="form-control" required>--}}
                                {{--<option value="">Choose One...</option>--}}

                                {{--@foreach ($channels as $channel)--}}
                                    {{--<option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>--}}
                                        {{--{{ $channel->name }}--}}
                                    {{--</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            {!!  Form::label('', '') !!}
                            {!!  Form::textarea('body',null,['id'=> 'editor','class' => 'locatorInput']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="column left">
                            <a href="{{redirect()->back()}}"><button class="button alert">Annulé</button></a>
                        </div>
                        <div class="column right">
                            {!! Form::submit('Edition', ['class' => 'button blue']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
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
                        {!! Form::submit('Répondre', ['class' => 'button blue']) !!}
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
                    <div class="row  pad10">
                        <div class="column ">
                            <div class="row   ">
                                <div class="column fts_080">
                                    par {{userName($reply->owner->USER_id,'noID')}} - {{$reply->created_at->diffForHumans()}}
                                </div>
                            </div>
                            <div class="row borderb padb5">
                                <div class="column">
                                    {!! $reply->body !!}
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach
                <br>
            @else
                <div class="row">
                    <div class="column">
                        <span class="googleT b"> Aucunes reponses pour le moment</span>
                    </div>
                </div>
                <br>
            @endif


        </div>

        {{--fin MODULE--}}


    </div>
    {{----FIN CONTAINER-----}}
@stop