@extends('templateModule')


@section('t')
    Taches
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('content')
    <div class="row ">
        <div class="col-lg-12">
            <h1>semaine</h1>
        </div>
    </div>

    <div class="row ">
        @foreach($week->getWeek() as $index => $day)
            <div class="column large-2 ">
                <div class="row border_module">
                    <div class="column">
                        {{substr($week->days[$day->dayOfWeek],0,3)}}.
                        <h1>{{$day->format('d')}}</h1>
                    </div>
                </div>
                @for($i = 1 ; $i <= 1 ; $i++)
                    <div class="row border_module">
                        <div class="column" style="height: 700px ;">
                            @if(isset($delais[$day->format('Y-m-d')]))

                                @php $delais_ = $delais[$day->format('Y-m-d')] ; @endphp

                                @foreach($delais_ as $indexD => $work)
                                    @php $bl = $work->id_cmd @endphp
                                    <div class="row" style="padding :2px 15px 2px 1px">
                                        @if($work->inc == 1)
                                            <div class="column bg_blue white border_module">
                                                @else
                                                    <div class="column bg_blue white border_module">
                                                        @endif

                                                        <div class="row">
                                                            @if(0 == true)
                                                            <div class="column large-2 left hidden" style="padding: 0 0 0 2px">
                                                                <span class="b blue" style="
                                                                font-size: 14px;
                                                                background-color:white; padding: 1px ;border-radius: 3px">
                                                                    {{isset($users[$work->user_prepa]) ?
                                                                    strtoupper($users[$work->user_prepa] )
                                                                    :
                                                                    ''}}
                                                                </span>
                                                            </div>
                                                            @endif
                                                            <div class="column large-7 left"
                                                                 style="letter-spacing: 2px; padding: 0 0 0 7px">
                                                                {{$bl}}
                                                            </div>

                                                            <div class="column large-5 right " style="padding: 0 4px 0 0">
                                                                <a href="{{action('TeamController@daySub',['bl' => $bl])}}">
                                                                    <i class="fa fa-angle-left white"> </i>
                                                                </a>
                                                                &nbsp;
                                                                <a href="{{action('TeamController@dayAdd',['bl' => $bl])}}">
                                                                    <i class="fa fa-angle-right white"> </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="column" style="padding: 0 0 0 3px">
                                                                <small>Ferco - SAS - compagny</small>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @if($work->close == 1)
                                                                <div class="column large-3 left ">
                                                                    <small><i class="fa fa-check"> </i></small>
                                                                </div>
                                                            @endif

                                                            <div class="column right" style="padding: 0 0 0 2px">
                                                                <small>
                                                                    @if($work->inc == 1)
                                                                        <i class="fa fa-exclamation-triangle"> </i>
                                                                        &nbsp;&nbsp;
                                                                    @endif

                                                                    @if($work->inc == 1)
                                                                        <i class="fa fa-bell"> </i>
                                                                        &nbsp;&nbsp;
                                                                    @endif

                                                                    @if($work->da == 1)
                                                                        <i class="fa fa-cc-visa"> </i>
                                                                        &nbsp;&nbsp;
                                                                    @endif

                                                                </small>
                                                            </div>
                                                        </div>

                                                    </div>
                                            </div>

                                            @endforeach
                                        @endif
                                    </div>
                        </div>
                        @endfor

                    </div>
                    @endforeach
            </div>
@stop