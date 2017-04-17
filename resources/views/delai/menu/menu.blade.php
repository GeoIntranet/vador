<ul class="vertical menu" data-accordion-menu>

    <li><a  href=""><b>General</b></a></li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Dates</a>
        <ul class="menu vertical nested">
            <li class="fts_080"><a href="{{action('DelaisController@filtre',['type'=>'date','value' => 'ASC'])}}">
                    @if($cmd->options['date'] == 'ASC') <b>Croissante</b> @else Croissante @endif
                </a>
            </li>
            <li class="fts_080"><a href="{{action('DelaisController@filtre',['type'=>'date','value' => 'DESC'])}}">
                    @if($cmd->options['date'] == 'DESC') <b>Décroissante</b> @else Décroissante @endif

                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Categories</a>
        <ul class="menu vertical nested">

            @if($cmd->options['categorie'] == 'ALL')
            <li class="fts_080"><a href="{{action('DelaisController@filtre',['type'=>'categorie','value' => 'ALL'])}}">
                   <b>Aucun filtre</b>
                </a>
            </li>
            @endif


            @foreach($categories as $keyCatName => $valCatName)

                @if($valCatName == 'Jet d\'encre')
                    <li class="fts_080">
                        <a href="{{action('DelaisController@filtre',['type'=>'categorie','value' => $keyCatName])}}">
                            @if($cmd->options['categorie'] == $keyCatName) <b>{{$valCatName}}</b> @else {{$valCatName}}@endif
                        </a>
                    </li>
                @elseif($valCatName == 'Transport')

                @elseif($valCatName == 'Main d\'oeuvre')

                @else
                    <li class="fts_080">
                        <a href="{{action('DelaisController@filtre',['type'=>'categorie','value' => $keyCatName])}}">
                            @if($cmd->options['categorie'] == $keyCatName) <b>{{$valCatName}}</b> @else {{$valCatName}}@endif
                        </a>
                    </li>
                @endif

            @endforeach
        </ul>
    </li>

    <li>
        <a href=""><i class="fa fa-angle-right b "></i> Utilisateurs</a>

        <ul class="menu vertical nested">
            @if ($cmd->options['user'] == 'ALL')
            <li class="fts_080"><a href="##">
                    <b>Aucun filtre</b>
                </a>
            </li>
            @endif
            @foreach($users as $id)
                <li class="fts_080">
                    <a href="
                        {{ action('DelaisController@filtre',[ 'type' => 'user', 'value' => $id ] ) }}
                            ">
                        @if($explosedUser->has($id))
                            <b>{{$user_[$id]['prenom']}} {{$user_[$id]['nom']}}</b>
                        @else
                            {{$user_[$id]['prenom']}} {{$user_[$id]['nom']}}
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </li>


</ul>