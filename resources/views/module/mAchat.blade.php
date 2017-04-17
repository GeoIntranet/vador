<?php $m =$module['mAchat']  ;?>

<div class="row">
    <div class="medium-12 column ">
        <div class="row pad7">
            <div class="medium-12 columns mContainer">

                <div class="row mTitle align-middle">

                    <div class=" medium-10 column  left">
                       <span class="InlineBlock"><i class="fa fa-euro green"></i></span>
                       <span class="InlineBlock dk"><h5 class="googleR"><b class="green googleB">A</b>chats</h5></span>
                    </div>

                    @include('module.mSettingA')

                </div>

                

                <div class="row mContent">
                    <table class=" Small tAchat">
                        <thead class="">
                            <tr class="">
                               <th></th>
                               <th class="">&#8212 DA </th>
                               <th> Article </th>
                            </tr>
                        </thead>
                        <tbody class="left ">

                            @foreach($m as $k => $v)

                                <?php $ct = $v['dt']->format('d/m/Y').' '.strtolower($v['tool']);  ?>

                                <tr class="">

                                   <td><i class="fa fa-angle-right"></i></td>

                                   <td>
                                        <a href="//intranet/po15_voir_demande.php?filtre=DA{{$v['id']}}">
                                             {{$v['id']}}
                                        </a>
                                   </td>

                                   <td>
                                        <div class="has-tip[tip-top] has-tip top" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title=" Le {{$ct}}">
                                            {{$v['ref']}} - {{ strtolower($v['description'])}}
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