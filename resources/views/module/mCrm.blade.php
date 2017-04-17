<?php  $m = $module['mCrm'] ; ?>
<div class="row">
    <div class="medium-12 column ">
        <div class="row pad7">
            <div class="medium-12 columns mContainer">

                <div class="row mTitle align-middle">

                    <div class=" medium-10 column  left">
                       <span class="InlineBlock"><i class="fa fa-star yellow"></i></span>
                       <span class="InlineBlock blk"><h5><b class="yellow">C</b>rm</h5></span>
                    </div>
                    @include('module.mSettingCrm')

                </div>



                <div class="row mContent">
                    @if($m != FALSE)
                        <table class=" Small tCrm">
                            <thead class="">
                                <tr class="">
                                   <td></td>
                                   <th>Action</th>
                                   <th class=""> Date </th>
                                   <th> Client </th>
                                   <th> Objet </th>
                                </tr>
                            </thead>
                            <tbody class="left mIndex">

                                @foreach($m as $k => $v)

                                    <tr class="">
                                        <td><i class="fa fa-angle-right"></i></td>
                                        <td> {{$v['TA']}}</td>

                                          <?php
                                             //$m=substr($v['dt'],5,2);
                                             //$d=substr($v['dt'],8,2);
                                             //$h=substr($v['dt'],11,5);
                                             //$dtt = $d.' / '.$m.' à '.$h;
                                             //$dtt_ = ' à '.$h;
                                             //$ct = $dtt_

                                            $ct = 'le '.$v['dt']->copy()->format('d/m ').' a ' . $v['dt']->copy()->format('H').'h'. $v['dt']->copy()->format('s');
                                          ?>

                                        <td>
                                            <div class="has-tip[tip-top] has-tip top " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="  {{$ct}}">
                                                 Le {{$v['dt']->copy()->format('d/m ')}}
                                            </div>

                                        </td>

                                        <td> <a href="">{{$v['client']}}</a></td>
                                        <td>
                                             <div class="has-tip[tip-top] has-tip top toolTipsCrm" data-tooltip aria-haspopup="true" data-width="1200" data-disable-hover="false" data-options='show_on:medium' title=" le {{ $v['infoT']}}">
                                                   {{ $v['info']}}
                                             </div>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="medium-12 column">
                            <h6>Ce module est actuellement Indisponible </h6>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>