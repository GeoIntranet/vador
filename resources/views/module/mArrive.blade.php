<?php $m = $module['mArrive'] ;?>

<div class="row">
    <div class="medium-12 column ">
        <div class="row pad7">
            <div class="medium-12 columns mContainer">

                <div class="row mTitle align-middle">

                    <div class=" medium-10 column  left">
                       <span class="InlineBlock"><i class="fa fa-share blue"></i></span>
                       <span class="InlineBlock blk"><h5><b class="blue">A</b>rrivées</h5></span>
                    </div>
                    @include('module.mSettingArr')

                </div>

                <div class="row mContent">
                    <table class=" Small tArrive">
                        <thead class="">
                            <tr class="">
                               <th></th>
                               <th class="">&#8212 ID &#8212</th>
                               <th> Déscription </th>
                            </tr>
                        </thead>
                        <tbody class="left mIndex googleR">

                            @foreach($m as $k => $v)
                                <tr class="">
                                    <td><i class="fa fa-angle-right"></i></td>
                                    <td>
                                       <a href="{{action('locatorController@forceSearching',['id',$v['id']])}}">
                                           ID{{$v['id']}}
                                       </a>

                                    </td>
                                    <td>
                                        <?php
                                            $var = $v['type'].' - '.$v['marque'].' - '.$v['designation'];
                                            $ct = $v['dt']->format('d/m/Y').' '.strtolower($var);
                                        ?>

                                        <div class="has-tip[tip-top] has-tip top" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" le {{$ct}}">
                                              {{strtolower($v['titre'])}}
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