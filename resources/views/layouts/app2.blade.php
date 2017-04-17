<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/lab/resources/assets/css/application.css"  media="screen"  />
	<link rel="SHORTCUT ICON" href="/eurocomputer/public/asset/favicon.ico" />

    <title>Laravel</title>

</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">

        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->


	<script type="text/javascript" src="/lab/resources/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/lab/resources/assets/js/jquery-ui.js"></script>
    <script src="/lab/resources/assets/js/dist/foundation.js"></script>
    <script>
    $(document).foundation();

    $(document).ready(function(){

        var $switch = $('#exampleSwitch');
        $switch.bind('click',function(){
            if( $switch.is(':checked') == true){
                 $('#expanded').addClass('expanded');
                 $('#expanded_').addClass('expanded');
            }
            else{
                $('#expanded').removeClass('expanded');
                $('#expanded_').removeClass('expanded');
            }
        });

    });

    </script>
</body>
</html>
