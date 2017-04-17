<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<div class="row">
    <?php  var_dump($request->old())?>
</div>
<body>
    {!! Form::open(['url' => action('FlashControlle@errorsFlash'), 'class' => 'form-horizontal']) !!}

    {!! Form::text('fs', old('fs-name'), ['class' => 'form-control']) !!}
    {!! Form::submit('Submit', ['class' => 'form-control']) !!}

    {!! Form::close() !!}
</body>
</html>
