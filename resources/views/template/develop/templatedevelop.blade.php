<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset(elixir('css/app.css'))}}">
    <link rel="SHORTCUT ICON" href="{{asset('favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('css/arduino-light.css')}}">


    <title>@yield('t')</title>
</head>

<body class="" >

{{--TOP BAR----------------------------------------------------------------------------------------------------------------------------------}}
@yield('menu')
{{--FIN TOP BAR------------------------------------------------------------------------------------------------------------------------------}}

    <div class="container">

        <br>

        {{--CONTENUE ------------------------------------------------------------------------------------------------------------------------}}
        <div class="row">

            <div class=" menu_mrg column medium-12 mContainer">
                {{--TITRE PRINCIPALE---------------------------------------------------------------------------------------------------------}}
                <div class="row">
                    <div class="column medium-12 padt10">
                        <h2 class="googleB"> <i class="fa fa-eyedropper " ></i> GUIDE style css </h2>
                        <hr>
                    </div>
                </div>
                {{--FIN TITRE PRINCIPALE-----------------------------------------------------------------------------------------------------}}

                {{--CONTAINER PRINCIPALE------------------------------------------------------------------------------------------------------}}
                <div class="row">
                    <div class="column medium-12 small-12 large-12 ">
                        <div class="row">

                            {{--MENU ---------------------------------------------------------------------------------------------------------}}
                            <div class="medium-2 column padr10">
                                @include('develop.menu')
                            </div>
                            {{--FIN MENU------------------------------------------------------------------------------------------------------}}

                            {{--COLONE ESPACEMENT --------------------------------------------------------------------------------------------}}
                            {{--<div class="medium-1 column"></div>--}}
                            {{--FIN COLONE ESPACEMENT ----------------------------------------------------------------------------------------}}

                            {{-- COLONE CONTENUE DE LA SECTION SELECTIONNER  -----------------------------------------------------------------}}
                            <div class="medium-10 column">
                                <div class="row">
                                    <div class="column medium-12">
                                        {{-- TITRE SECTION SELECTIONNER ----------------------------------------------------------------------}}
                                        <div class="row">
                                            <div class="column medium-12"><h3 class="googleB">@yield('titreSection')</h3></div>
                                        </div>
                                        {{-- FIN TITRE SECTION SELECTIONNER -------------------------------------------------------------------}}


                                        <div class="row">
                                            @yield('contenuSection')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- FIN COLONE CONTENUE DE LA SECTION SELECTIONNER  -------------------------------------------------------------}}

                        </div>
                        <br>
                    </div>
                </div>
                {{--FIN CONTAINER PRINCIPALE--------------------------------------------------------------------------------------------------}}

            </div>

        </div>
        {{-- FIN CONTENUE -----------------------------------------------------------------------------------------------------------------}}

        <br>

    </div>

        <script type="text/javascript" src="{{asset('js/jq.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/all.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/hl.js')}}"></script>
        <script>
            $(document).ready(function(){

                hljs.initHighlightingOnLoad();
            });

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