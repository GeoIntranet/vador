@extends('template.develop.templatedevelop')

@section('titreSection')
    <i class="fa fa-picture-o"></i> Palette couleurs
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('contenuSection')

    <div class="column medium-12 ">


        <div class="row pad5">
            <div class="column medium-11 bgW pad10">
                <ul class="c">
                    <li>Liste des couleurs <u class="googleB">primaires</u></li>
                    <li>Liste des couleurs <u class="googleB">secondaire</u></li>
                    <li>Etablissement des <u class="googleB">règles</u> à utiliser sur les couleurs</li>
                    <li>les différentes utilisation par évènement / thèmes</li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="column medium-12">
                <h4 class="googleB">Primaires</h4>
            </div>
        </div>

        <div class="row ">
            <div class="column medium-2 pad3 center"> Rouge </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Vert</div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Bleu</div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Jaune</div>
        </div>

        <div class="row  center">
            <div class="column medium-2 center "><div class="row pad5 align-middle"><div class="column block_color bg_red">#CD5C5C</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_green">#1D9D74</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_blue">#3B5998</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_yellow">#FF9900</div></div> </div>
        </div>

        {{--<div class="row align-middle">--}}
            {{--<div class="column medium-6">--}}
                {{--<pre><code class="css">--}}
{{--$red: #CD5C5C;--}}
{{--.bg_red{ background-color: $red;}--}}
                    {{--</code></pre>--}}
            {{--</div>--}}

            {{--<div class="column medium-6">--}}
                {{--<pre><code class="html">--}}
{{--&lt;div class="column bg_red"&gt;;#CD5C5C&lt;/div&gt;--}}
                    {{--</code></pre>--}}
            {{--</div>--}}
        {{--</div>--}}


        <hr>
        <div class="row">
            <div class="column medium-12">
                <h4 class="googleB">Secondaires</h4>
            </div>
        </div>

        <div class="row">
            <div class="column medium-2 pad3 center"> Charbon <br> <u>#222222</u></div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Gris foncé <br> <u>#8a8a8a</u></div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Gris <br> <u>#cacaca</u></div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Gris clair <br> <u>#e6e6e6</u></div>
        </div>

        <div class="row ">
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_charbon">&nbsp</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_darkgrey">&nbsp</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_grey">&nbsp</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_lightgrey">&nbsp</div></div> </div>
        </div>


        <div class="row">
            <div class="column medium-2 pad3 center"> Dark Brown </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Brown </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Orange </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Violet </div>
        </div>
        <div class="row ">
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_darkbrown">#333333</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_brown">#777266</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_orange">#EC5840</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_violet">#cd78c7</div></div> </div>
        </div>

        <hr>
        <div class="row">
            <div class="column medium-12">
                <h4 class="googleB">Bordures</h4>
            </div>
        </div>

        <div class="row">
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Bordure Module  <br> <u>#d0d1d5</u></div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Bordure titre <br> <u>#e9eaed</u></div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Bordure footer <br> <u>#f1f1f1</u></div>
            <div class="column medium-1"></div>

        </div>

        <div class="row ">
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_border_modul">&nbsp</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_border_tt">&nbsp</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_border_footer">&nbsp</div></div> </div>
            <div class="column medium-1"></div>

        </div>
        <hr>
        <div class="row">
            <div class="column medium-12">
                <h4 class="googleB">Background </h4>
            </div>
        </div>

        <div class="row">
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Background application  <br> <u>#e9eaed</u></div>
            <div class="column medium-1"></div>
            <div class="column medium-2 pad3 center"> Background content module <br> <u>#f6f7f8</u></div>
            <div class="column medium-1"></div>
        </div>

        <div class="row ">
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_c">&nbsp</div></div> </div>
            <div class="column medium-1"></div>
            <div class="column medium-2 center "><div class="row pad5"><div class="column block_color bg_content border_module">&nbsp</div></div> </div>
            <div class="column medium-1"></div>
        </div>

        <hr>

        <div class="row">
            <div class="column medium-12">
                <h4 class="googleB">Variable</h4>
                <p>References des différentes variable , avec une déscription de son utilité  | <b class="googleBi">_variable.scss</b> </p>
                <p> <i class="fa fa-angle-right"></i> Application/resources/assets/sass/</p>
            </div>
        </div>
        <div class="row">

            <table class="table-guide-style">

                <thead>
                    <tr class="googleB">
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Valeur</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody>
                    <tr> <td><b>$red</b></td> <td>couleur</td> <td>#CD5C5C</td> <td>Utilisation dans le menu , et pour signalisation d'une erreur</td>
                    <tr> <td class=" b">$green</td> <td>couleur</td> <td>#1D9D74</td><td>Utilisé dans module Incident , et signalisation Sucess</td>
                    <tr> <td class=" b">$blue</td> <td>couleur</td> <td>#3B5998</td><td>Utilisé dans module achat / information , et signalisation info</td>
                    <tr> <td class=" b">$fb</td> <td>couleur</td> <td>#3B5998</td><td>Idem $blue</td>
                    <tr> <td class=" b">$yellow</td> <td>couleur</td> <td>#FF9900</td><td>Utilisé dans module crm , et signalisation warning</td>
                    <tr> <td class=" b">$darker_gray</td> <td>couleur</td> <td>#222222</td><td>Couleur de fond du menu</td>
                    <tr> <td class=" b">$dark_grey</td> <td>couleur</td> <td>#8a8a8a</td><td>Couleur d'emphase icone / titre / a définir</td>
                    <tr> <td class=" b">$grey</td> <td>couleur</td> <td>#cacaca</td><td>Couleur d'emphase icone / titre / a définir</td>
                    <tr> <td class=" b">$medium grey</td> <td>couleur</td> <td>#cacaca</td><td> - </td>
                    <tr> <td class=" b">$light_grey</td> <td>couleur</td> <td>#e6e6e6</td><td> - </td>
                    <tr> <td class=" b">$ft_ctt</td> <td>couleur</td> <td>#333333</td><td> - </td>
                    <tr> <td class=" b">$ft_titre</td> <td>couleur</td> <td>#777266</td><td> - </td>
                    <tr> <td class=" b">$orange</td> <td>couleur</td> <td>#EC5840</td><td> - </td>
                    <tr> <td class=" b">$rose</td> <td>couleur</td> <td>#cd78c7</td><td> - </td>
                    <tr> <td class=" b">$border-modul</td> <td>couleur</td> <td>#d0d1d5</td><td> - </td>
                    <tr> <td class=" b">$border-tt</td> <td>couleur</td> <td>#e9eaed</td><td> - </td>
                    <tr> <td class=" b">$border-footer</td> <td>couleur</td> <td>#f1f1f1</td><td> - </td>
                    <tr> <td class=" b">$bgc</td> <td>couleur</td> <td>#e9eaed</td><td> - </td>
                    <tr> <td class=" b">$bgc-content</td> <td>couleur</td> <td>#f6f7f8</td><td> - </td>
                </tbody>

            </table>

        </div>
    </div>
    </div>

@stop
