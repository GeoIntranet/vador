<?php $m =$module['mInfo'] ;?>
<div class="row">
    <div class="medium-12 column ">
        <div class="row pad7">
            <div class="medium-12 columns mContainer">

                <div class="row mTitle align-middle">

                    <div class=" medium-10 column  left">
                       <span class="InlineBlock"><i class="fa fa-info-circle blue fts_130"></i></span>
                       <span class="InlineBlock blk"><h5><b class="blue">I</b>nformations</h5></span>
                    </div>
                    @include('module.mSettingInfo')

                </div>


                <div class="row mContent">
                <div class="medium-12 column ">

                    <div class="row left">

                        <div class="medium-12 column SoustitreBox">

                                <div class="has-tip[tip-top] has-tip InlineBlock  fts_130 padl3" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" Ajouter une absence">
                                    <a class="" href=""><i class="fa fa-plus-circle  nfo padr2"> </i> </a>
                                </div>

                            <div class="InlineBlock blk "> <h6 class="b dk"> &nbsp Absence</h6></div>

                        </div>
                    </div>
                    @foreach($m['ABS'] as $key => $v)
                        <?php $motif = strtolower($v->motif) ?>
                        <div class="row left  dk fts_075 pad5">

                            <div class="large-6 medium-6 small-6 column">
                                @if(substr_count($motif, 'malade') != 0 )
                                    <span class="inlineblock show-for-medium-only_"> <i
                                                class="fa fa-user-md   fts_130"></i> </span>
                                @elseif(substr_count($motif, 'perso') != 0)
                                    <span class="inlineblock show-for-medium-only_"> <i class="fa fa-info fts_130"></i> </span>
                                @elseif(substr_count($motif, 'recup') != 0)
                                    <span class="inlineblock show-for-medium-only_"> <i class="fa fa-home  fts_130"></i> </span>
                                @elseif(substr_count($motif, 'cp') != 0)
                                    <span class="inlineblock show-for-medium-only_"> <i
                                                class="fa fa-star  yellow fts_130"></i> </span>
                                @elseif(substr_count($motif, 'vacance') != 0)
                                    <span class="inlineblock show-for-medium-only_"> <i
                                                class="fa fa-star  yellow fts_130"></i> </span>
                                @elseif(substr_count($motif, 'vacances') != 0)
                                    <span class="inlineblock show-for-medium-only_"> <i
                                                class="fa fa-star  yellow fts_130"></i> </span>
                                @elseif(substr_count($motif, 'inter') != 0)
                                    <span class="inlineblock show-for-medium-only_"> <i
                                                class="fa fa-wrench   fts_130"></i> </span>
                                @elseif(substr_count($motif, 'congé') != 0)
                                    <span class="inlineblock show-for-medium-only_"> <i
                                                class="fa fa-star  yellow fts_130"></i> </span>
                                @endif

                                <div class="has-tip[tip-top] has-tip tCenter" data-tooltip aria-haspopup="true"
                                     data-disable-hover="false" data-options='show_on:medium' title=" {{$v->motif}}">
                                    <span class="inlineblock emp small"> {{ substr($v->prenom,0,1).'.'. substr($v->nom,0,8).'..'}}</span>
                                </div>
                            </div>

                            <div class="medium-6 column large-6 small-6">
                                <span class="inlineblock"> le {{substr($v->dt_in,8,2)}}/{{substr($v->dt_in,5,2)}}
                                    à {{substr($v->dt_in,11,5)}}</span>
                            </div>


                        </div>

                    @endforeach


                    <hr class="pt sm"/>

                    <div class="row left">
                        <div class="medium-12 column  SoustitreBox">
                             <h6 class="b dk">Général</h6>
                        </div>
                    </div>

                    <div class="row left dk">
                        <div class="medium-12 column fts_090  ">
                        <ul class="c">

                            {{--<li >--}}
                                {{--@if($m['V'] == TRUE)--}}
                                    {{--<span class="emp">Vendredi</span>--}}
                                {{--@else Hier @endif,--}}
                                {{--il y a eu <span class="b empBLK">{{$m['exp']}}</span> commandes expediées.--}}
                            {{--</li>--}}

                            <li >
                               Il y a actuellement, <span class="b empBLK">{{$m['enc']}}</span> fiches en cours.
                            </li>

                            <li>
                                <span class="b empBLK"> {{$m['incidentO']}} </span> incidents ouverts , et
                                <span class="b empBLK">{{$m['audit']}}</span> machines a auditer.
                            </li>

                            <li class="UlNone ">&nbsp</li>

                            <li class="UlNone ">
                                 &#8212 <span class=" emp"> <em>Bon travail </em></span> <i class="fa fa-thumbs-up blue" ></i>
                            </li>
                        </ul>
                        </div>
                    </div>


                    @if(!empty($m['anniv']))
                        <hr class="pt sm"/>
                        <div class="row pad5">
                            <div class="medium-12 column left b ">
                             Joyeux anniversaire
                            </div>
                            <div class="medium-12 column left  dk">
                                <i class="fa fa-angle-right "></i> <u> {{ ucfirst($m['anniv']['prenom']) }}  {{ ucfirst(strtolower($m['anniv']['nom']))}}</u> &#8212 <i class="fa fa-birthday-cake red"></i>
                            </div>
                        </div>
                    @endif


                </div>
                <?php //var_dump($k[$m]['data']); ?>
                </div>

            </div>
        </div>
    </div>
</div>