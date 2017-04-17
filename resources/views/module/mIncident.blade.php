<?php $module_ = $module['mIncident'] ;?>
<?php $m = $module['mIncident']['data'] ;?>

<div class="row ">
    <div class="medium-12 column ">
        <div class="row pad7">
            <div class="medium-12 columns mContainer">

                <div class="row mTitle align-middle">

                    <div class=" medium-9 column  left ">
                       <span class="InlineBlock"><i class="fa fa-warning red"></i></span>

                       <a href="{{route('incident.index')}}">
                           <span class="InlineBlock blk "><h5 class="googleR"><b class="red ">I</b>ncidents</h5></span>
                       </a>

                       <a class="dk" href="{{route('mkviewer', [ 'x'=> Auth::user()->id ] )}}">
                           -
                           <span class=" emp  fts_080"><b>{{$module_['actif']}}</b>  actif</span>
                       </a>

                    </div>

                    @include('module.mSetting')

                </div>


            @if(isset($module_['nonLu']))
                 @if($module_['nonLu'] > 0)
                    <div class="row mContent ">
                        <div class="medium-12 large-12 small-12 pad5">
                            <span class="BoxAlertWarning">
                                <i class="fa fa-angle-right"></i>&nbsp
                                <b class="emp">{{$module_['nonLu']}}</b>
                                @if($module_['nonLu'] > 1)
                                    incidents <u>non</u> lus
                                @else
                                    incident  <u>non</u> lu
                                @endif
                                <em>sur</em> <b class="emp">{{$module_['actif']}}</b> actif
                            </span>
                        </div>
                    </div>
                @endif
            @endif
                <div class="row mContent">
                    <table class="Small tIncident">

                        <thead class=" ">
                            <tr class="">
                               <th><i class="fa fa-angles-right"></i></th>
                               <th class="">N°</th>
                               <th> Détails </th>
                            </tr>
                        </thead>

                        <tbody class="left mIndex googleR">

                            @foreach($m as $k => $v)

                                <tr class="">

                                   <td>
                                       @if($v['etat'] == 1)
                                           <i class="fa fa-square b red"></i>
                                       @else
                                           <i class="fa fa-angle-right"></i>
                                       @endif
                                   </td>

                                   <td>
                                        <a href="{{route('incident.show',['u' => $v['id'] ]) }}">
                                            {{$v['id']}}
                                        </a>
                                   </td>

                                    <?php $ct = $v['dt']->format('d/m/Y').' '.strtolower($v['titre']);?>


                                    <td>
                                        <div class="has-tip[tip-top] has-tip top "
                                             data-tooltip aria-haspopup="true"
                                             data-disable-hover="false"
                                             data-options='show_on:medium'
                                             title=" le {{$ct}}">
                                            {{ strtolower(substr($v['titre'],0,25))}}
                                        </div>
                                   </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>