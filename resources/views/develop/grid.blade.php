@extends('template.develop.templatedevelop')

@section('titreSection')
    <i class="fa fa-tasks"></i> Utilisation de la grille
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('contenuSection')

    <div class="column medium-12 ">

        <div class="row pad10">
            <div class="column medium-11 bgW pad10">
                <ul class="c">
                    <li>Container - <u class="googleB">row</u></li>
                    <li>Nombre de colonnes 12 - <u class="googleB">column</u> ou <u class="googleB">columns</u></li>
                    <li>3 types de tailles pour la visibilité en responsive -  small - medium - large - <u class="googleB">small-6</u></li>
                    <li>Si pas de precision de tailles , sa divise la largeur total par le nombre de colonne</li>

                </ul>
            </div>
        </div>

        <div class="row">
            <div class="column medium-12"><h4 class="googleB">La base</h4></div>
        </div>

        <div class="row pad10  googleR align-middle">
            <div class="column medium-7 white ">

                <div class="row center  pad5">
                    <div class="column bgmain2">1</div>
                </div>

                <div class="row center  pad5">
                    <div class="column bgmain2">2</div>
                    <div class="column bgmain3">2</div>
                </div>

                <div class="row center pad5 ">
                    <div class="column bgmain2">3</div>
                    <div class="column bgmain3">3</div>
                    <div class="column bgmain2">3</div>
                </div>

                <div class="row center pad5">
                    <div class="bgmain2 column medium-3">4</div>
                    <div class="bgmain3 column medium-3">4</div>
                    <div class="bgmain2 column medium-3">4</div>
                    <div class="bgmain3 column medium-3">4</div>
                </div>

                <div class="row center pad5">
                    <div class="bgmain2 column medium-2">6</div>
                    <div class="bgmain3 column medium-2">6</div>
                    <div class="bgmain2 column medium-2">6</div>
                    <div class="bgmain3 column medium-2">6</div>
                    <div class="bgmain2 column medium-2">6</div>
                    <div class="bgmain3 column medium-2">6</div>
                </div>
                <div class="row center pad5">
                    <div class="bgmain2 column medium-1">12</div>
                    <div class="bgmain3 column medium-1">12</div>
                    <div class="bgmain2 column medium-1">12</div>
                    <div class="bgmain3 column medium-1">12</div>
                    <div class="bgmain2 column medium-1">12</div>
                    <div class="bgmain3 column medium-1">12</div>
                    <div class="bgmain2 column medium-1">12</div>
                    <div class="bgmain3 column medium-1">12</div>
                    <div class="bgmain2 column medium-1">12</div>
                    <div class="bgmain3 column medium-1">12</div>
                    <div class="bgmain2 column medium-1">12</div>
                    <div class="bgmain3 column medium-1">12</div>
                </div>
                <br>

            </div>

            <div class="column medium-5">
                     <pre><code class="">
&lt;div class="row"&gt;
    &lt;div class="column medium-1"&gt;
         One
    &lt;/div&gt;
&lt;/div&gt;
             </code></pre>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="column medium-12"><h4 class="googleB">Offset</h4></div>
        </div>

        <div class="row pad10  googleR align-middle">

            <div class="column medium-7 white">
                <div class="row center  pad5 bgmain3">
                    <div class="column medium-offset-1 medium-2 bgmain2">3</div>
                    <div class="column medium-offset-2 medium-2 bgmain2">3</div>
                    <div class="column medium-offset-2 medium-2 bgmain2">3</div>
                </div>
            </div>

            <div class="column medium-5">
                     <pre><code class="html">
&lt;div class="row"&gt;
 &lt;div class="column medium-1 medium-offset-2"&gt;
  One
 &lt;/div&gt;
&lt;/div&gt;
             </code></pre>
            </div>

        </div>
        <hr>

        <div class="row">
            <div class="column medium-12"><h4 class="googleB">Alignement</h4></div>
        </div>
        <div class="row">
            <div class="column medium-12"><h5 class="googleB">Milieu</h5></div>
        </div>

        <div class="row pad10  googleR align-middle">

            <div class="column medium-7 white">
                <div class="row align-middle bgmain2">
                    <div class="columns bgmain3">I'm in the middle!</div>
                    <div class="columns bgmain4">I am as well, but I have so much text I take up more spaco soluta, quod provident distinctio aliquam omnis? Labore, ullam possimus.</div>
                </div>
            </div>

            <div class="column medium-5">
                     <pre><code class="html">
&lt;div class="row align-middle"&gt;
    &lt;div class="column "&gt;
        ...
    &lt;/div&gt;
    &lt;div class="column "&gt;
        ...
    &lt;/div&gt;
&lt;/div&gt;
             </code></pre>
            </div>

        </div>

        <hr>
        <div class="row">
            <div class="column medium-12"><h5 class="googleB">Haut</h5></div>
        </div>

        <div class="row pad10  googleR align-middle">

            <div class="column medium-7 white">
                <div class="row align-top bgmain2">
                    <div class="columns bgmain3">I'm in the top!</div>
                    <div class="columns bgmain4">I am as well, but I have so much text I take up more spaco soluta, quod provident distinctio aliquam omnis? Labore, ullam possimus.</div>
                </div>
            </div>

            <div class="column medium-5">
                     <pre><code class="html">
&lt;div class="row align-top"&gt;
    &lt;div class="column "&gt;
        ...
    &lt;/div&gt;
    &lt;div class="column "&gt;
        ...
    &lt;/div&gt;
&lt;/div&gt;
             </code></pre>
            </div>

        </div>

        <hr>
        <div class="row">
            <div class="column medium-12"><h5 class="googleB">Bas</h5></div>
        </div>

        <div class="row pad10  googleR align-middle">

            <div class="column medium-7 white">
                <div class="row align-bottom bgmain2">
                    <div class="columns bgmain3">I'm in the bottom!</div>
                    <div class="columns bgmain4">I am as well, but I have so much text I take up more spaco soluta, quod provident distinctio aliquam omnis? Labore, ullam possimus.</div>
                </div>
            </div>

            <div class="column medium-5">
                     <pre><code class="html">
&lt;div class="row align-bottom"&gt;
    &lt;div class="column "&gt;
        ...
    &lt;/div&gt;
    &lt;div class="column "&gt;
        ...
    &lt;/div&gt;
&lt;/div&gt;
             </code></pre>
            </div>

        </div>

        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    </div>
@stop
