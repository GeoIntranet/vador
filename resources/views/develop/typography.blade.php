@extends('template.develop.templatedevelop')

@section('titreSection')
    Typogr<i class="fa fa-font"></i>phy
@stop


@section('menu')
    @include('menu.navbars')
@stop

@section('contenuSection')
<div class="column medium-12">

    <br>
    <div class="row">
        <div class="column medium-11 bgW pad10">
            <ul class="c">
                <li>Header Size</li>
                <li>Font face</li>
            </ul>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="column "><h3 class="googleB"> <i class="fa fa-header"></i> eader</h3></div>
    </div>

    <div class="row">
        <div class="columns"> <h1>H1 . This is a very large header</h1> </div>
    </div>

    <div class="row">
        <div class="columns"> <h2>H2 . This is a large header</h2> </div>
    </div>

    <div class="row">
        <div class="columns"> <h3>H3 . This is a medium header</h3> </div>
    </div>

    <div class="row">
        <div class="columns"> <h4>H4 . This is a moderate header</h4> </div>
    </div>

    <div class="row">
        <div class="columns"> <h5>H5 . This is a small header</h5> </div>
    </div>

    <div class="row">
        <div class="columns"> <h6>H6 . This is a tiny header</h6> </div>
    </div>

    <hr>

    <div class="row">
        <div class="column">
            <h3 class="googleB"><i class="fa fa-at"></i> font-Face</h3>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="columns"> <h3 class="googleB">H3 - This is  Google Bold Font</h3> </div>
    </div>

    <div class="row">
        <div class="columns"> <h3 class="googleBi">H3 . This is  Google Bold Italic Font</h3> </div>
    </div>
    <br>

    <div class="row">
        <div class="columns"> <h3 class="googleR">H3 . This is  Google Regular Font</h3> </div>
    </div>

    <div class="row">
        <div class="columns"> <h3 class="googleRi">H3 . This is  Google Regular Italic Font</h3> </div>
    </div>
    <br>


    <div class="row">
        <div class="columns"> <h3 class="googleT">H3 . This is  Google Thineless Font</h3> </div>
    </div>

    <div class="row">
        <div class="columns"> <h3 class="googleTi">H3 . This is  Google Thineless Italic Font</h3> </div>
    </div>
    <hr>


    <div class="row">
        <div class="column">
            <h3 class="googleB"><i class="fa fa-hashtag"></i> Other</h3>
        </div>
    </div>

    <div class="row">
        <div class="columns"> <strong>Test</strong> </div>
    </div>

    <div class="row">
        <div class="columns"> <small>Test</small> </div>
    </div>

    <div class="row">
        <div class="columns"> <em>Test</em> </div>
    </div>

    <div class="row">
        <div class="columns"> <code>Test</code> </div>
    </div>

    <div class="row">
        <div class="columns"> <pre>Test</pre> </div>
    </div>

    <div class="row">
        <div class="columns">  <abbr >Geoffrey Valero</abbr> </div>
    </div>

    <div class="row">
        <div class="columns">  <blockquote >Geoffrey Valero</blockquote> </div>
    </div>

    <div class="row">
        <div class="columns"><a href="">Hyperlink</a> </div>
    </div>

    <div class="row">
        <div class="columns"><kbd>Cmd+Q</kbd> </div>
    </div>


    <div class="row">
        <div class="columns">
            <dl>
                <dt>Time</dt>
                <dd>The indefinite continued progress of existence and events in the past, present, and future regarded as a whole.</dd>
                <dt>Space</dt>
                <dd>A continuous area or expanse that is free, available, or unoccupied.</dd>
                <dd>The dimensions of height, depth, and width within which all things exist and move.</dd>
            </dl>
        </div>
    </div>


    <div class="row">
        <div class="columns">
            <ol>
                <li>Cheese (essential)</li>
                <li>Pepperoni</li>
                <li>Bacon
                    <ol>
                        <li>Normal bacon</li>
                        <li>Canadian bacon</li>
                    </ol>
                </li>
                <li>Sausage</li>
                <li>Onions</li>
                <li>Mushrooms</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <ul>
                <li>List item with a much longer description or more content.</li>
                <li>List item</li>
                <li>List item
                    <ul>
                        <li>Nested list item</li>
                        <li>Nested list item</li>
                        <li>Nested list item</li>
                    </ul>
                </li>
                <li>List item</li>
                <li>List item</li>
                <li>List item</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <ul class="c">
                <li>List item with a much longer description or more content.</li>
                <li>List item</li>
                <li>List item
                    <ul>
                        <li>Nested list item</li>
                        <li>Nested list item</li>
                        <li>Nested list item</li>
                    </ul>
                </li>
                <li>List item</li>
                <li>List item</li>
                <li>List item</li>
            </ul>
        </div>
    </div>

    <br>

</div>


    
@stop