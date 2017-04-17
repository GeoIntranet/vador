<ul class="vertical menu" data-accordion-menu>
    <li><a  href=""><b>General</b></a></li>
    <li class="emp"></li>
    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Année</a>
        <ul class="menu vertical nested">

            <?php $y = $dateSent->copy()->format('Y'); ?>
            @for($i=0 ; $i < 3 ; $i++)
                @if($i == 0)
                    <?php $linkYear = action('CalenderController@selectYear',['controller' => 'CommandSentClassifyController','year' => $now->format('Y')]) ?>

                    @if($y == $now->format('Y'))
                        <li><a href="{{$linkYear}}"><b>{{$now->format('Y')}}</b></a></li>
                    @else
                        <li><a href="{{$linkYear}}">{{$now->format('Y')}}</a></li>
                    @endif

                @endif

                    <?php $linkYear = action('CalenderController@selectYear',['controller' => 'CommandSentClassifyController','year' => $now->copy()->subYear(1)->format('Y')]) ?>

                    @if($y == $now->copy()->subYear(1)->format('Y'))
                        <li><a href="{{$linkYear}}"><b>{{$now->subYear(1)->format('Y')}}</b></a></li>
                    @else
                        <li><a href="{{$linkYear}}">{{$now->subYear(1)->format('Y')}}</a></li>
                    @endif

            @endfor
        </ul>
    </li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Mois</a>
        <ul class="menu vertical nested">
            @foreach($calender as $keyMonth => $month)

                <?php $linkYear = action('CalenderController@selectMonth',['controller' => 'CommandSentClassifyController','year' => $keyMonth]) ?>

                    @if($dateSent->copy()->month == $keyMonth)
                        <li><a href="{{$linkYear}}"><b>{{$month}}</b></a></li>
                    @else
                        <li><a href="{{$linkYear}}">{{$month}}</a></li>
                    @endif

            @endforeach
        </ul>
    </li>

    <li class="emp"></li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Ajouter</a>
        <ul class="menu vertical nested">
            <?php $dt = $dateSent->copy()->format('Y-m-d');?>

            <li><a href="{{action('CommandSentClassifyController@LogicExecutionOnDay',['date' => $dt])}}">Jour selectionné</a></li>
            <li><a href="{{action('CommandSentClassifyController@LogicExecutionOnWeek',['date' => $dt])}}">Semaine en cours</a></li>
            <li><a href="{{action('CommandSentClassifyController@LogicExecutionOnMonth',['date' => $dt])}}">Mois en cours</a></li>
            <li><a href="{{route('integerYear',['date' => $dt])}}">Année en cours</a></li>
        </ul>
    </li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Effacer</a>
        <ul class="menu vertical nested">
            <li><a href="{{action('CommandSentClassifyController@disptachDestroy',['order' => 'day', 'dt' => $dt])}}">Jour en cours</a></li>
            <li><a href="{{action('CommandSentClassifyController@disptachDestroy',['order' => 'week', 'dt' => $dt])}}">Semaine en cours</a></li>
            <li><a href="{{action('CommandSentClassifyController@disptachDestroy',['order' => 'month', 'dt' => $dt])}}">Mois en cours</a></li>
            <li><a href="{{action('CommandSentClassifyController@disptachDestroy',['order' => 'year', 'dt' => $dt])}}">Année en cours</a></li>
            <li><a href="{{action('CommandSentClassifyController@disptachDestroy',['order' => 'all', 'dt' => $dt])}}">Tout effacer</a></li>
        </ul>
    </li>


</ul>