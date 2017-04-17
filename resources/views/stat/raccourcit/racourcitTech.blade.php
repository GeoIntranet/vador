<div class="row align-middle">

    <span class="has-tip[tip-bottom] has-tip medium-2 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Module de statistique liée aux utilisateurs">
              Utilisateur
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Resumé">
        <a class="" href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>'all' , 'year' => $request->year])}}">
              <i class="fa fa-bars"></i>
        </a>
    </span>

    @if($request->year <>'2014')
    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Année précédente ">
        <a class="" href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => $request->year-1])}}">
              <i class="fa fa-angle-left"></i>
        </a>
    </span>
    @endif

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Année en cours">
        <a class="" href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => $now->year])}}">
              <i class="fa fa-clock-o"></i>
        </a>
    </span>

    @if($request->year <>'2016')
        <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
              data-disable-hover="false" data-options='show_on:medium' title="Année suivante">
        <a class="" href="{{action('StatController@disptachJob',['job' => $request->job , 'user'=>$request->user , 'year' => $request->year+1])}}">
              <i class="fa fa-angle-right"></i>
        </a>
    </span>
    @endif

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
        data-disable-hover="false" data-options='show_on:medium' title="Aficher les stats des préparations">
        <a class="" href="{{action('StatController@disptachJob',['job' => 'preparation' , 'user'=>$request->user , 'year' => $request->year])}}">
              <i class="fa fa-archive"></i>
        </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
        data-disable-hover="false" data-options='show_on:medium' title="Afficher les stats incidents">
        <a class="" href="{{action('StatController@disptachJob',['job' => 'incident' , 'user'=>$request->user , 'year' => $request->year])}}">
              <i class="fa fa-bell"></i>
        </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
        data-disable-hover="false" data-options='show_on:medium' title="Telecharger en PDF">
        <a class="" href="">
            <i class="fa fa-file-pdf-o"></i>
        </a>
    </span>


    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
        data-disable-hover="false" data-options='show_on:medium' title="Imprimer">
        <a class="" href="">
              <i class="fa fa-print"></i>
        </a>
    </span>

    <span class="has-tip[tip-bottom] has-tip medium-1 center   iconeRaccourcit" data-tooltip aria-haspopup="true"
          data-disable-hover="false" data-options='show_on:medium' title="Statistique general">
        <a class="" href="{{action('StatController@general')}}">
              <i class="fa fa-gear"></i>
        </a>
    </span>


</div>