<div class="row align-middle">

    <span class="has-tip[tip-bottom] has-tip medium-2 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Module de statistique general">
              General
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Famille article">

        <a class="" href="{{action('FamilleController@index')}}">
              <i class="fa fa-cubes"></i>
        </a>

    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Envois classés">
          <a class="" href="{{action('CommandSentClassifyController@index')}}">
            <i class="fa fa-folder"></i>
          </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Statistique technicien">
        <a class="" href="{{action('StatController@disptachJob',['job'=>'preparation','user' =>'all' ,'year' => $now->year])}}">
              <i class="fa fa-users"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Les vendeurs">
        <a class="" href="">
              <i class="fa fa-black-tie"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Les ventes">
        <a class="" href="">
              <i class="fa fa-euro"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Les client">
        <a class="" href="">
              <i class="fa fa-briefcase"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center  iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Les materiel expedié">
        <a class="" href="">
              <i class="fa fa-road"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip  medium-3 right  iconeRaccourcit"
          data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Acceuil">
        <a class="" href="">
              <i class="fa fa-home"></i>
        </a>
    </span>




</div>