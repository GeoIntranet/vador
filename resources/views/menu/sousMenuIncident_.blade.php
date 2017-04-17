<li class="">


    <div class="row  tmenu_incident">
        <div class="large-10 medium-10 column left">GESTION</div>
        <div class="large-1  medium-1 column right"><i class="fa fa-cog"></i></div>
    </div>

    <div class="row expanded white  left">
        <div class="column small-12 medium-12 large-6 left bordering">

            <div class="row  menu_incident">
                <div class="large-1 medium-1   column"><i class="fa fa-pencil fa-2x "></i></div>
                <div class="column  medium-10 large-10 "><a href="">Prise D'appel</a></div>
            </div>

            <div class="row  menu_incident">
                <div class="column medium-1 large-1 "><i class="fa fa-user fa-2x "></i> </div>
                <div class="column medium-10 large-10 "><a href="{{action('IncidentController@MakeViewer',[Auth::id()])}}"> Mes incidents </a></div>
            </div>

            <div class="row menu_incident">
                 <div class="column medium-1  large-1 "><i class="fa fa-table fa-2x "></i></div>
                 <div class="column medium-10 large-10 "> <a href="{{action('IncidentController@index')}}">Incidents utilisateurs</a></div>
            </div>

        </div>

        <div class="column large-6  center ">
             <div class="row Tmenu_incident bgd">
                  <div class="column large-12  white ">Profil favoris</div>
             </div>


                @foreach($avatar_->chunk(5) as $chunk)
                <div class="row menu_incident ">
                    @foreach($chunk as $user => $ico)

                        <?php $url = url("imgs/trombinoscope/32x32/$ico"); ?>
                            <div class="column center img_avatar">

                                <a href="{{action('IncidentController@MakeViewer',[$user])}}">
                                    <img class="avatar" src={{$url}} alt={{$ico}}/>
                                </a>
                            </div>

                     @endforeach
                </div>
                @endforeach
        </div>

    </div>

    <div class="row expanded tmenu_incident show-for-large">
        <div class="column large-11  left">AFFICHAGE</div>
        <div class="column large-1  right"><i class="fa fa-bars"></i></div>
    </div>

    <div class="row expanded left show-for-large">
        <div class="column large-6  left bordering">
            <div class="row  menu_incident">
                <div class="column large-1 "><i class="fa fa-clock-o fa-2x "></i></div>
                <div class="column large-10 "><a href="">En cours</a></div>
            </div>
            <div class="row  menu_incident">
                <div class="column large-1 "><i class="fa fa-times fa-2x "></i></div>
                <div class="column medium-10 "> <a href="">Cloturer</a></div>
            </div>
            <div class="row   menu_incident">
               <div class="column medium-1 "><i class="fa fa-reply-all fa-2x "></i> </div>
               <div class="column medium-10 "><a href="">Derniers vue </a></div>
            </div>
        </div>

        <div class="column large-6  center bordering">
            <div class="row Tmenu_incident bgd">
                <div class="column large-12  white ">derniers edité</div>
            </div>

            <div class="row menu_incident pad3">
                @if(isset($incidents_redis))
                    @foreach($incidents_redis as $incident)
                        <div class="pad3 column small-12 medium-2 large-2 ">
                            <a href="{{action('IncidentController@show',[$incident->id_incid])}}">{{$incident->id_incid}}</a>
                        </div>
                        <div class="pad3 column small-12 medium-10 large-10 ">
                            <a href="{{action('IncidentController@show',[$incident->id_incid])}}">{{strtolower(substr($incident->titre,0,40))}}</a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>


    </div>
    <br/>
</li>