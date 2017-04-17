<?php $m = $module['mContent']; ?>
<div class="row">
    <div class="medium-12 column ">
        <div class="row pad7">
            <div class="medium-12 columns mContainer">

                <div class="row mTitle align-middle">
                    <div class=" medium-10 column  left">
                       <span class="InlineBlock fts_120"><i class="fa fa-dashboard "></i>&nbsp&nbsp</span>
                       <span class="InlineBlock dk"><h5 class="googleB"><b class="blk">D</b>ASHBOARD</h5></span>
                    </div>
                </div>

                @include('module.cUserInfo')

                @if(isset($m['toSearch']))
                    @foreach( $m['toSearch'] as $index => $mod)
                       @include('module.c'.$mod)
                    @endforeach
                @endif


                <div class="row mFooter">
                    &nbsp

                    <div class="medium-4 column left SoustitreBox contentFooter hide">
                            <span class="has-tip[tip-top] has-tip InlineBlock  padl3" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" Ajout News">
                                <a class="" href=""><i class="fa fa-plus-square  nfo"> </i> </a>
                            </span>
                            <span class="InlineBlock "> <h6> &nbsp Ajouter une news</h6></span>
                    </div>

                    <div class="medium-4 column left SoustitreBox contentFooter hide">
                            <span class="has-tip[tip-top] has-tip InlineBlock  padl3" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" Ajout Favoris">
                                <a class="" href=""><i class="fa fa-plus-square  nfo"> </i> </a>
                            </span>
                            <span class="InlineBlock "> <h6> &nbsp Ajouter un favoris</h6></span>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>