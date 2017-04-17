<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{asset(elixir('css/app.css'))}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

<br>
@foreach($zones as $zoneName => $zone)
    @if($zoneName == 2 )
    <div class="row ">Zone {{$zoneName}}</div>

    <div class="row ">

        <table  class="pad0 locator">
            <col><col><col><col><col><col><col><col><col><col><col><col><col><col><col>
            <tr>
                <td> &nbsp</td>
            </tr>
            @for($i = 1 ; $i <=5 ; $i++)
                <tr class="" >
                    <?php $col = 1; ?>
                    @foreach($elements as $element => $value)
                        @if($value['zone'] == $zoneName)
                            @if( ( $value['name'] <> 'J' )  AND ( $col % 2 == 0))<td width="120" class="pad0 bg2 center empty"> &nbsp </td>@endif
                            <td   class="center pad0 fts_075 separator_zone">
                                <table  class="pad0 locator">
                                    <?php $end = $exception->has($value['name'].$i) ? 4 : 3 ; ?>
                                    @for($a=1 ; $a <= $end ; $a++)
                                        <tr class="break">
                                            <td class="">
                                                <a href="{{action('locatorController@show',[$value['name'].$i.'0'.$a])}}">
                                                    <b>{{$value['name']}}</b> {{$i.'0'.$a}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endfor
                                </table>
                            </td>
                        @endif
                        <?php $col++; ?>
                    @endforeach
                </tr>
            @endfor
            <tr>
                <td> &nbsp</td>
            </tr>
        </table>
    </div>
    @endif
@endforeach

</body>

</html>