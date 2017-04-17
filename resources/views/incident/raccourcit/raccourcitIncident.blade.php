<div class="row align-middle hidden-print">

    <span class="has-tip[tip-bottom] has-tip medium-3 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Incident specifique">

        <a class="" href="{{route('statEnvoie')}}">
             -
        </a>

    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Edit cet incident">

        <a class="" href="{{route('incident.edit',$incident['id_incid'])}}">
              <i class="fa fa-pencil"></i>
        </a>

    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Cloture cet incident">
        <a class="" href="">
              <i class="fa fa-close"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Crée un incident">
          <a class="" href="">
            <i class="fa fa-plus"></i>
          </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Retour a tes incidents">
          <a class="" href="{{route('incidents')}}">
            <i class="fa fa-reply"></i>
          </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip  medium-5 right  iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Acceuil Incident">
        <a class="" href="{{route('incident.index')}}">
              <i class="fa fa-home"></i>
        </a>
    </span>




</div>