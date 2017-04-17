

<nav class="navi ">

    <div class="row expanded hide-for-print">

        <div class="column small-4 medium-9 large-10   hide-for-print">

            <ul class="">

                {{--BOUTON EN MODE SMALLL-----------------------------------------------------------------------}}
                <li class="width show-for-small-only">
                    <button class="menu-icon show-for-small-only" type="button" data-open="offCanvasLeft"></button>
                </li>
                {{----------------------------------------------------------------------------------------------}}

                {{--DIVERS POUR IDENTIFIANT USER BOUTON CONFIG ETC ---------------------------------------------}}
                {{--<li class="space">&nbsp</li>--}}
                {{----------------------------------------------------------------------------------------------}}

                {{--DIVERS POUR IDENTIFIANT USER BOUTON CONFIG ETC ---------------------------------------------}}
                <li class="user ">
                    <a href="{{action('BoardController@index')}}">
                        @if(isset($avatar))
                            <?php $url = asset('imgs/trombinoscope/' . $avatar . '');?>
                            <img class="{{$admin}}" src={{$url}} alt="GV"/>
                        @else
                            <?php $url = asset('imgs/trombinoscope/NC.png');?>
                                <img class="noAdmin" src={{$url}} alt={{$avatar}}/>
                        @endif
                    </a>

                </li>
                {{----------------------------------------------------------------------------------------------}}
                <li class=" show-for-small-only">
                    <div class="switch pad5">
                        <input class="switch-input" id="exampleSwitch" type="checkbox" name="exampleSwitch" value="on">
                        <label class="switch-paddle" for="exampleSwitch">
                            <span class="show-for-sr">Vue etendue</span>
                        </label>
                    </div>
                </li>

                {{--INCIDENT------------------------------------------------------------------------------------}}
                <li class=" NameMenu  show-for-medium">
                    <a class="SubMenu " href="{{action('IncidentController@incidentUser')}}">
                        <i class="fa fa-warning show-for-medium-only incview"></i>
                        <span class="show-for-large"><i class="fa fa-warning "></i> <b>I</b>NCIDENT</span>
                    </a>

                    <ul class="T1">
                        @include('menu.sousMenuIncident_')
                    </ul>

                </li>

                {{--LOCATOR------------------------------------------------------------------------------------}}
                <li class=" NameMenu  show-for-medium">
                    <a class="SubMenu" href="{{action('locatorController@index')}}">
                        <i class="fa fa-car show-for-medium-only"></i>
                        <span class="show-for-large"><i class="fa fa-car "></i> <b>L</b>OCATOR</span>
                    </a>

                    <ul class="T2">
                        @include('menu.sousMenuLocator')
                    </ul>
                </li>

                {{--ACHAT------------------------------------------------------------------------------------}}
                <li class=" NameMenu  show-for-medium">

                    <a class="SubMenu" href="">
                        <i class="fa fa-euro show-for-medium-only"></i>
                        <span class="show-for-large"><i class="fa fa-euro "></i> <b>A</b>CHAT</span>
                    </a>

                    <ul class="T3">
                        @include('menu.sousMenuAchat')
                    </ul>
                </li>

                {{--INCIDENT------------------------------------------------------------------------------------}}
                <li class=" NameMenu  show-for-medium">

                    <a class="SubMenu" href="">
                        <i class="fa fa-star show-for-medium-only"></i>
                        <span class="show-for-large"><i class="fa fa-star "></i> <b>C</b>RM</span>
                    </a>

                    <ul class="T4">
                        @include('menu.sousMenuCrm')
                    </ul>
                </li>

                {{--UTILITAIR------------------------------------------------------------------------------------}}
                <li class=" NameMenu  show-for-medium">

                    <a class="SubMenu" href="">
                        <i class="fa fa-gear show-for-medium-only"></i>
                        <span class="show-for-large"><i class="fa fa-gear "></i> <b>U</b>TILITAIRE</span>
                    </a>

                    <ul class="T5">
                        @include('menu.sousMenuUtilitaire')
                    </ul>
                </li>
            </ul>
        </div>

        <div class="column small-8 medium-3 large-2 center white looper  hide-for-print">

            <ul class="menu searchPos">

                {!! Form::open(['action' => 'SearchController@index']) !!}
                    {!! Form::hidden('from', json_encode(Route::getCurrentRoute()->getAction()), ['id' => 'id']) !!}
                    <li><input name='search' class="searchingBox" type="search" placeholder="Search" autofocus></li>
                {!! Form::close() !!}
                <li class="InputLoupe"><i class="fa fa-flip-horizontal fa-search search_btn "></i></li>
            </ul>

        </div>
    </div>

</nav>




           
