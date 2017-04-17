
<div class="row mUser align-middle googleT b ">
    @if(isset($module['mContent']))

        <?php $user = $module['mContent']['user']; ?>
        <?php $date = $module['mContent']['date'];?>


        <div class=" fts_090 div column large-4 meidum-4 small-4 left pad5">
            &#8212
            <span class=" ">
                {!! $date !!}
            </span>
        </div>

        <div class="fts_090 large-8 small-12 medium-12 column right  pad5 ">

            <a href='#'><i class="fa fa-gear dk"></i></a>
            {{substr($user['prenom'],0,1)}}. {{ $user['nom']}} &#8212

            @if($user['admin'] == true)
                <b class="red googleT b ">Administrateur</b>
            @endif

            <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" Déconnexion">
                <a href="{{action('Auth\AuthController@logout')}}">
                    <span class="fa-stack fa-lg ">
                      <i class="fa fa-circle fa-stack-2x deco dk"></i>
                      <i class="fa fa-lock fa-stack-1x fa-inverse "></i>
                    </span>
                </a>
            </span>

        </div>
    @endif

</div>