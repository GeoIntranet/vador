<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="SHORTCUT ICON" href="/eurocomputer/public/asset/favicon.ico" />
	<meta charset="UTF-8">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/module.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/pattern.css')}}">--}}



	<title>@yield('t')</title>
</head>
<body class="bg1 croix5">
    <div class="container ">
        <div class="row expanded red h200 bg2 font_grille2">
            <div class="position_logo"><img src="{{asset('imgs/LoginEURO.png')}}" alt="" /></div>
        </div>
        <div class="row position_barre expanded"> <?php echo " &nbsp; "; ?></div>

			@yield('content')

    </div>



</body>
</html>