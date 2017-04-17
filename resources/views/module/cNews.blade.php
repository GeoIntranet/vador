<div class="row mContent align-middle">



    <div class="medium-12 column">

        <div class="row pad10">
            <div class="medium-12 column left ">
                <span class="InlineBlock "><i class="fa fa-newspaper-o dk"></i></span>
                <span class="InlineBlock dk"><h5 class="googleB"><b class="blk">N</b>ews</h5></span>
            </div>
        </div>
        
        <?php //var_dump($u['news']['news']); ?>

        @foreach($u['news']['news'] as $k => $v)
            <?php
                $now =  new \Carbon\Carbon();
                $dt = new \Carbon\Carbon($v->created_at);
            ?>
            
             <div class="row ">
                  <div class="medium-2 small-3 large-2 column">
                        <div class="row">
                            <div class="medium-12 column AVATAR">
                                <?php $ID = $u['news']['users'][$k]->USER_nom.' '.$u['news']['users'][$k]->USER_prenom?>
                                 <span class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title='{{$ID}}'>
                                     <img src= "/lab/resources/assets/imgs/trombinoscope/{{$u['news']['users'][$k]->USER_icone}}">
                                 </span>

                            </div>
                        </div>

                        <div class="row">
                            @if($now->format('Y-m-d') == $dt->format('Y-m-d'))
                                <div class="medium-12 column "> <span class="red b googleB emp fts_070">TODAY</span></div>
                            @elseif($now > $dt)
                                <div class="medium-12 column ">
                                    <i class="fa fa-circle blue fts_065"></i> <small class="dk">{{$dt->format('d-m')}}</small>
                                </div>
                            @else
                                <div class="medium-12 column "> <span class="red b googleB emp fts_060">le {{$dt->format('d-m')}}</span></div>
                            @endif
                        </div>

                  </div>

                  <div class="medium-10 small-8 large-10 left column dk">
                      <p class="googleT"> {{$v->NEW_content}} </p>
                  </div>

             </div>

                    <hr class="sm"/>
        @endforeach

        {{--<div class="row ">--}}

             {{--<div class="medium-2 small-3 large-2 column">--}}
                {{--<img src= "/lab/resources/assets/imgs/garcimore.png"><br/>--}}
                {{--<span class="red b googleB emp">Today</span>--}}
             {{--</div>--}}

             {{--<div class="medium-10 small-8 large-10 left column dk">--}}
                 {{--<p>I'm going to improvise. Listen, there's something you should know about me... about inception.--}}
                 {{--.</p>--}}
             {{--</div>--}}

        {{--</div>--}}

        {{--<hr class="sm"/>--}}

        {{--<div class="row ">--}}
             {{--<div class="medium-2 small-3 large-2 column">--}}
                       {{--<img src= "/lab/resources/assets/imgs/garcimore.png"><br/>--}}
                       {{--<i class="fa fa-circle blue fts_065"></i> <small class="dk">11 - Juil</small>--}}
             {{--</div>--}}
             {{--<div class="medium-10 small-8 large-10 left column dk">--}}
                 {{--<p>I'm going to improvise. Listen, there's something you should know about me... about inception.--}}
                 {{--</p>--}}
             {{--</div>--}}
        {{--</div>--}}
        {{--<hr class="sm"/>--}}

    </div>
</div>