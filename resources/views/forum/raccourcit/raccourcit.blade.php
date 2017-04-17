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
    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Précédent">
          <a class="" href="{{url()->previous()}}">
            <i class="fa fa-reply"></i>
          </a>
    </span>
    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Ajouter un sujet">
          <a class="" href="{{action('ThreadController@create')}}">
            <i class="fa fa-file"></i>
          </a>
    </span>
    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Reponse au sujet">
          <a class="" href="{{action('RepliesController@toggleWriteMode')}}">
            <i class="fa fa-pencil"></i>
          </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip  medium-7 right  iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Acceuil Locator">
        <a class="" href="{{action('locatorController@noSession')}}">
              <i class="fa fa-home"></i>
        </a>
    </span>




</div>