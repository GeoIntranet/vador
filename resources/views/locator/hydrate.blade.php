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
<hr>
<div class="row">
    <div class="column">
        <h1 class="googleB">Catégories</h1>
    </div>
</div>
<hr>

<div class="row ">
    <div class="column small-12">
        {!! Form::open(['route' => 'locator.store', 'method' => 'post']) !!}

        <div class="row">

            {!! Form::text('CAT_famille', 'CAT_famille', ['class' => 'column']) !!}

            <label class="column">
                {!! Form::checkbox('CAT_therm', '1', null,  ['id' => 'CAT_therm']) !!}
                Thermique
            </label>

            <label class="column">
                {!! Form::checkbox('CAT_pisto', '1', null,  ['id' => 'CAT_pistolet']) !!}
                Pistolet
            </label>

            <label class="column">
            	{!! Form::checkbox('CAT_as', '1', null,  ['id' => 'CAT_as']) !!}
            	AS400
            </label>

            <label class="column">
                {!! Form::checkbox('CAT_mat', '1', null,  ['id' => 'CAT_as']) !!}
                Matricielle
            </label>

            <label class="column">
                {!! Form::checkbox('CAT_jet', '1', null,  ['id' => 'CAT_as']) !!}
                Jet d'encre
            </label>

        </div>
        <hr>



        {!! Form::submit('Envoyé', ['class' => 'button btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>



</body>

</html>