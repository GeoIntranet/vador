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
    @foreach($locator['subValues'] as $index => $value)
        <div class="row border__">{{$index}}</div>

        <div class="row border_">
            <table class="pad0">
                <tbody class="pad0">
                @foreach($value as $index_row => $row)
                    <tr class="pad0">
                        @foreach($row as $index_col => $col)
                            <td class="center pad0 fts_075">{{$col['name']}}</td>
                            <td width="50" class="pad0 border__">  </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

</body>

</html>