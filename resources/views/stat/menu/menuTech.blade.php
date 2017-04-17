<ul class="vertical menu" data-accordion-menu>
    <li><a  href=""><b>General</b></a></li>
    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Année</a>
        <ul class="menu vertical nested">

            @if($request->year == '2016')
                <li><a href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => '2016'])}}"><b>2016</b></a></li>
            @else
                <li><a href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => '2016'])}}">2016</a></li>
            @endif

            @if($request->year == '2015')
                <li><a href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => '2015'])}}"><b>2015</b></a></li>
            @else
                <li><a href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => '2015'])}}">2015</a></li>
            @endif

            @if($request->year == '2014')
                <li><a href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => '2014'])}}"><b>2014</b></a></li>
            @else
                <li><a href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => '2014'])}}">2014</a></li>
            @endif

        </ul>
    </li>
    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Commandes</a>
        <ul class="menu vertical nested">
            <?php $linkAll =action('StatController@disptachJob',['job' => 'preparation' , 'user'=>'all' , 'year' => $request->year]) ?>
            <li>
                @if($request->user == 'all' AND $request->job == 'preparation')
                    <a href="{{$linkAll}}"><b> Résumé</b></a>
                @else
                   <a href="{{$linkAll}}">Résumé</a>
                @endif
            </li>
            @foreach($tech as $user)
               <?php $linkUser =action('StatController@disptachJob',['job' => 'preparation' , 'user'=>$user , 'year' => $request->year]) ?>

                   @if($request->user == $user AND $request->job == 'preparation')
                       <li><a href="{{$linkUser}}"><b> {{$userGlobal[$user]['prenom']}}</b></a> </li>
                   @else
                       <li><a href="{{$linkUser}}">{{$userGlobal[$user]['prenom']}}</a> </li>
                   @endif
            @endforeach

        </ul>
    </li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Incidents</a>
        <ul class="menu vertical nested">
            <?php $linkAll =action('StatController@disptachJob',['job' => 'incident' , 'user'=>'all' , 'year' => $request->year]) ?>
            <li>
                @if($request->user == 'all' AND $request->job == 'incident')
                    <a href="{{$linkAll}}"><b> Résumé</b></a>
                @else
                    <a href="{{$linkAll}}">Résumé</a>
                @endif
            </li>
            @foreach($tech as $user)
                <?php $linkUser =action('StatController@disptachJob',['job' => 'incident' , 'user'=>$user , 'year' => $request->year]) ?>

                @if($request->user == $user AND $request->job == 'incident')
                    <li><a href="{{$linkUser}}"><b> {{$userGlobal[$user]['prenom']}}</b></a> </li>
                @else
                    <li><a href="{{$linkUser}}">{{$userGlobal[$user]['prenom']}}</a> </li>
                @endif
            @endforeach
        </ul>
    </li>




</ul>