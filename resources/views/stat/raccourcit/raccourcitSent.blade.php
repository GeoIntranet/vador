<div class="row align-middle">

    <span class="has-tip[tip-bottom] has-tip medium-2 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Classification des envoies">

        <a class="" href="{{route('statEnvoie')}}">
              Envoie
        </a>

    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="General">

        <a class="" href="{{route('statGeneral')}}">
              <i class="fa fa-bars"></i>
        </a>

    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Jour J">
        <a class="" href="{{action('StatController@disptachJob',['job'=>'preparation','user' =>'all' ,'year' => $now->year])}}">
              <i class="fa fa-map-marker"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Ajout du jour">
          <a class="" href="{{route('integerDay',['dt'=>$dateSent->format('d-m-Y')])}}">
            <i class="fa fa-plus"></i>
          </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Suppression du jour">
          <a class="" href="{{route('deleteInteger',['order'=>'day','dt'=>$dateSent->format('d-m-Y')])}}">
            <i class="fa fa-minus"></i>
          </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip  medium-6 right  iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Acceuil">
        <a class="" href="{{route('statGeneral')}}">
              <i class="fa fa-home"></i>
        </a>
    </span>




</div>