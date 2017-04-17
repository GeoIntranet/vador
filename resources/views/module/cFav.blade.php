<?php  $fav = collect($m['Fav']);
//var_dump($fav);
?>
<div class="row mContent align-middle padb10 padt10">

    <div class="medium-12 column">

        <div class="row padt10 mContent ">

             <div class="medium-12 column left ">
                 <span class="InlineBlock "><i class="fa fa-bookmark dk"></i></span>
                 <span class="InlineBlock dk"><h5 class="googleB"><b class="blk">F</b>avoris</h5></span>
             </div>
        </div>
        @if( ! $fav->isEmpty() )
            @foreach ($fav->chunk(9) as $favsplit)
                <div class="row">
                    @foreach ($favsplit as $link)

                        <span data-tooltip aria-haspopup="true"
                              class="has-tip top linkContainer column  generique bg_{{$link['LINK_color']}}"
                              data-disable-hover="false"
                              tabindex="2"
                              title="{{$link['LINK_name']}}">

                              <a href="//{{$link['LINK_url']}}">
                                  <span class="googleB">
                                      {{strtoupper(substr($link['LINK_name'],0,1))}}
                                  </span>
                              </a>

                              <span class="linkIco ">
                                  <i class="fa {{$link['LINK_icone']}} {{$link['LINK_color']}}"></i>
                              </span>
                        </span>

                    @endforeach
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="medium-12 column">
                    <h6>Vous n'avez aucun favoris actuellement</h6>
                </div>
            </div>
        @endif
    </div>
</div>