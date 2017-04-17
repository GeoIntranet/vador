@extends('template.develop.templatedevelop')

@section('titreSection')
    <i class="fa fa-picture-o"></i> Icones de l'application
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('contenuSection')

    <div class="column medium-12 ">

        <div class="row">
            <div class="column medium-11 bgW pad10">
                <div class="pad10">
                    L'application utilise font-awesome , et sa police icone
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="column">
                <h4 class="googleB">Utilisation - listes incompletes</h4>
            </div>
        </div>

        <div class="row align-middle">
            <div class="column medium-6">
                <div class="row center">
                    <div class="column"><i class="fa fa-pencil"></i></div>
                    <div class="column"><i class="fa fa-warning"></i></div>
                    <div class="column"><i class="fa fa-wrench"></i></div>
                    <div class="column"><i class="fa fa-angle-right"></i></div>
                    <div class="column"><i class="fa fa-paper-plane"></i></div>
                    <div class="column"><i class="fa fa-object-group"></i></div>
                    <div class="column"><i class="fa fa-inbox"></i></div>
                    <div class="column"><i class="fa fa-empire"></i></div>
                </div>
                <hr>
                <div class="row center">
                    <div class="column"><i class="fa fa-universal-access"></i></div>
                    <div class="column"><i class="fa fa-umbrella"></i></div>
                    <div class="column"><i class="fa fa-trademark"></i></div>
                    <div class="column"><i class="fa fa-random"></i></div>
                    <div class="column"><i class="fa fa-language"></i></div>
                    <div class="column"><i class="fa fa-magic"></i></div>
                    <div class="column"><i class="fa fa-magnet"></i></div>
                    <div class="column"><i class="fa fa-qrcode"></i></div>
                </div>
                <hr>
                <div class="row center">
                    <div class="column"><i class="fa fa-opera"></i></div>
                    <div class="column"><i class="fa fa-adjust"></i></div>
                    <div class="column"><i class="fa fa-adn"></i></div>
                    <div class="column"><i class="fa fa-file-zip-o"></i></div>
                    <div class="column"><i class="fa fa-safari"></i></div>
                    <div class="column"><i class="fa fa-yahoo"></i></div>
                    <div class="column"><i class="fa fa-gears"></i></div>
                    <div class="column"><i class="fa fa-dashboard fa-border"></i></div>
                </div>
            </div>
            <div class="column medium-6">
                <pre><code class="html"> Base - &lt;i class="fa fa-pencil" &gt; &lt;i&gt;</code></pre> <br>
                <pre><code class="html">Taille de l'icone -  &lt;i class="fa fa-pencil fa-2x" &gt; &lt;i&gt; </code></pre> <br>
                <pre><code class="html">Bordure -  &lt;i class="fa fa-dashboard fa-border" &gt; &lt;i&gt; </code></pre>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="column">
                <h4 class="googleB">Rotation</h4>
            </div>
        </div>
        <div class="row align-middle">
            <div class="column medium-6">
                <div class="row center">
                    <div class="column"><i class="fa fa-shield"></i> normal</div>
                    <div class="column"><i class="fa fa-shield fa-rotate-90"></i> fa-rotate-90</div>
                    <div class="column"><i class="fa fa-shield fa-rotate-180"></i> fa-rotate-180</div>

                </div>
                <hr>
                <div class="row center">
                    <div class="column"><i class="fa fa-shield fa-rotate-270"></i> fa-rotate-270</div>
                    <div class="column"><i class="fa fa-shield fa-flip-horizontal"></i> fa-flip-horizontal</div>
                    <div class="column"><i class="fa fa-shield fa-flip-vertical"></i> fa-flip-vertical</div>
                </div>

            </div>
            <div class="column medium-6">
                <pre><code class="html"> 90 - &lt;i class="fa fa-shield fa-rotate-90" &gt; &lt;i&gt; </code></pre>
                <br>
                <pre><code class="html">198 -  &lt;i class="fa fa-rotate-180" &gt; &lt;i&gt;</code></pre>
                <br>
                <pre><code class="html">... -  &lt;i class="fa fa-rotate-..." &gt; &lt;i&gt; </code></pre>

            </div>
        </div>

        <hr>
        <div class="row">
            <div class="column">
                <h4 class="googleB">Stacked</h4>
            </div>
        </div>

        <div class="row align-middle">
            <div class="column medium-6">

                <div class="row center">
                    <div class="column left">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-twitter fa-stack-1x"></i>
                        </span>
                        fa-twitter on fa-square-o<br>
                    </div>
                </div>
            </div>
            <div class="column medium-6">
                <pre><code class="html">&lt;span class="fa-stack fa-lg"&gt;
  &lt;i class="fa fa-square-o fa-stack-2x"&gt;&lt;/i&gt;
  &lt;i class="fa fa-twitter fa-stack-1x"&gt;&lt;/i&gt;
&lt;/span&gt;</code></pre>
            </div>
        </div>

        <br>

        <div class="row align-middle">
            <div class="column medium-6">

                <div class="row center">
                    <div class="column left">
                      <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
                      </span>
                        fa-flag on fa-circle<br>
                    </div>
                </div>
            </div>
            <div class="column medium-6">
                <pre><code class="html">&lt;span class="fa-stack fa-lg"&gt;
  &lt;i class="fa fa-circle fa-stack-2x"&gt;&lt;/i&gt;
  &lt;i class="fa fa-flag fa-stack-1x fa-inverse"&gt;&lt;/i&gt;
&lt;/span&gt;</code></pre>
            </div>
        </div>

        <br>

        <div class="row align-middle">
            <div class="column medium-6">

                <div class="row center">
                    <div class="column left">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
                        </span>
                        fa-terminal on fa-square<br>
                    </div>
                </div>
            </div>
            <div class="column medium-6">
                <pre><code class="html">&lt;span class="fa-stack fa-lg"&gt;
  &lt;i class="fa fa-square fa-stack-2x"&gt;&lt;/i&gt;
  &lt;i class="fa fa-terminal fa-stack-1x fa-inverse"&gt;&lt;/i&gt;
&lt;/span&gt;</code></pre>
            </div>
        </div>

        <br>

        <div class="row align-middle">
            <div class="column medium-6 ">

                <div class="row center">
                    <div class="column left">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-camera fa-stack-1x"></i>
                          <i class="fa fa-ban fa-stack-2x red"></i>
                        </span>
                        fa-ban on fa-camera
                    </div>
                </div>
            </div>
            <div class="column medium-6">
                <pre><code class="html">&lt;span class="fa-stack fa-lg"&gt;
  &lt;i class="fa fa-camera fa-stack-1x"&gt;&lt;/i&gt;
  &lt;i class="fa fa-ban fa-stack-2x text-danger"&gt;&lt;/i&gt;
&lt;/span&gt;</code></pre>
            </div>
        </div>



    </div>

@stop
