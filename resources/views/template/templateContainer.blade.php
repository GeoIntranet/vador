<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset(elixir('css/app.css'))}}">
    <style type="text/css">@font-face {
            font-family:"googleB";
            src: url("{{env('FONT')}}build/fonts/Roboto-Bold-webfont.eot"),
            url("{{env('FONT')}}build/fonts/Roboto-Bold-webfont.woff") format("woff"),
            url("{{env('FONT')}}'build/fonts/Roboto-Bold-webfont.svg#filename") format("svg");
        }
        .googleB{ font-weight: bold; }
    </style>

    <style type="text/css">@font-face {
            font-family: "googleR";
            src: url("{{env('FONT')}}build/fonts/Roboto-Regular-webfont.eot"),
            url("{{env('FONT')}}build/fonts/Roboto-Regular-webfont.woff") format("woff"),
            url("{{env('FONT')}}build/fonts/Roboto-Regular-webfont.svg#filename") format("svg");
        }
    </style>

    <style type="text/css">@font-face {
            font-family: "googleBI";
            src: url("{{env('FONT')}}build/fonts/Roboto-BoldItalic-webfont.eot"),
            url("{{env('FONT')}}build/fonts/Roboto-BoldItalic-webfont.woff") format("woff"),
            url("{{env('FONT')}}build/fonts/Roboto-BoldItalic-webfont.svg#filename") format("svg");
        }
    </style>

    <style type="text/css">@font-face {
            font-family: "googleT";
            src: url("{{env('FONT')}}build/fonts/Roboto-Thin-webfont.eot"),
            url("{{env('FONT')}}build/fonts/Roboto-Thin-webfont.woff") format("woff"),
            url("{{env('FONT')}}build/fonts/Roboto-Thin-webfont.svg#filename") format("svg");
        }
    </style>

    <style type="text/css">

        @font-face {
            font-family: "googleTI";
            src: url("{{env('FONT')}}build/fonts/Roboto-ThinItalic-webfont.eot");
            src: url("{{env('FONT')}}build/fonts/Roboto-ThinItalic-webfont.woff2") format("woff2"),
            url("{{env('FONT')}}build/fonts/Roboto-ThinItalic-webfont.woff") format("woff"),
            url("{{env('FONT')}}build/fonts/Roboto-ThinItalic-webfont.svg#filename") format("svg");
        }
    </style>



    <link rel="shortcut icon" href="{{env('domain')}}"  type="image/x-icon" />

    <title>Board</title>
</head>

<body class="application" >
    <div class="body-content">
          <div class="off-canvas-wrapper">
                <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
                    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
                        <ul class="c">
                            <li> <a href=""><i class="fa fa-close " data-close="offCanvasLeft"></i></a></li>
                            <li>test</li>
                            <li>test</li>
                            <li>test</li>
                            <li>test</li>
                            <li>test</li>
                            <li>test</li>
                            <li>test</li>
                            <li>test</li>
                        </ul>
                    </div>

                    <div class="off-canvas-content" data-off-canvas-content>

                        {{--TOP BAR--------------------------------------------------------------------------------------}}
                        @include('menu.navbars')
                        {{--FIN TOP BAR-----------------------------------------------------------------------------------}}

                        {{--CONTENUE --------------------------------------------------------------------------------------}}
                            @include("template.templateDisplay$templateNumber")
                        {{--FIN CONTENU -----------------------------------------------------------------------------------}}

                    </div>
                </div>


              <script type="text/javascript" src="{{asset('js/jq.js')}}"></script>
              <script type="text/javascript" src="{{asset('js/all.js')}}"></script>
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

<footer class="footer">
    <div class=" bgmain10 pad10">
        @include('footer.footer')
    </div>
</footer>

</html>