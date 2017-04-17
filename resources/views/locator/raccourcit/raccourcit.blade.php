<div class="row align-middle hidden-print">

    <span class="has-tip[tip-bottom] has-tip medium-2 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Recherche en cours">

        <a class="fts_070" href="{{route('statEnvoie')}}">
            @if(isset($nameFilter))
                {{$nameFilter}}
                @else
                -
            @endif
        </a>

    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Dépot">
        <a href={{action('locatorController@depot')}}>
              <i class="fa fa-table"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Nouvelle recherche">

        <a class="" href="{{action('locatorController@noSession')}}">
              <i class="fa fa-search"></i>
        </a>

    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Dernière arrivé">
          <a class="" href="{{action('locatorController@getLastIn')}}">
            <i class="fa fa-plus"></i>
          </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Dernières sorties">
          <a class="" href="{{action('locatorController@lastOut')}}">
            <i class="fa fa-reply"></i>
          </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Multi ID">
          <a class="" href="{{action('locatorController@getMulti')}}">
            <i class="fa fa-th-list"></i>
          </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Catalogue">
        <a href={{action('locatorController@getCatalogue')}}>
              <i class="fa fa-book"></i>
        </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip  medium-4 right  iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Acceuil Locator">
        <a class="" href="{{action('locatorController@noSession')}}">
              <i class="fa fa-home"></i>
        </a>
    </span>




</div>