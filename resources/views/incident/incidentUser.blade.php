@extends('templateModule')


@section('t')
    Incidents - {{userName($manager->user,'noID')}}
@stop



@section('content')
<br/>

    <div class="row ">
        <div class=" medium-4 column ">
                 <a href="{{route('incident.index')}}">
                    <h2 class="googleB"> <span class="emp">En cours</span> </h2>
                 </a>
             </div>
        <div class=" medium-8 column ">
            <h2 class="googleB">Incidents de {{userName($manager->user)}} </h2>
        </div>

    </div>

    <div class="row ">
        <div class="small-12 medium-12 large-4  column padr10">

            <table class="">
                <thead>
                    <tr class=" fts_110">
                       <th class="">
                            <i class="fa fa-bell dk pad4"></i>
                       </th>

                       <th>
                            <i class="fa fa-phone pad4"></i>
                       </th>

                       <th class="">
                             <i class="fa fa-user pad4"></i>
                       </th>

                       <th>
                            <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="En cours">
                                <i class="fa fa-folder-open pad4"></i>
                            </span>
                       </th>


                    </tr>
                </thead>

                <tbody class="fts_090">
                @if(isset($table))
                   @foreach($table['data'] as $user => $incident)

                        <tr class="fts_080">
                          <td>
                              @if(isset($warning[$user]))

                                  <span class="has-tip[tip-top] has-tip  "
                                        data-tooltip aria-haspopup="true"
                                        data-disable-hover="false"
                                        data-options='show_on:medium'
                                        title="Incident NON-LU"
                                  >
                                        <i class="fa fa-bell red fts_110"></i>
                                  </span>
                              @endif

                          </td>

                           <td>56 </td>

                           <td>



                               @if(isset($users[$user]))
                                   <?php $c = 'Voir les incidents de '.substr($users[$user]['prenom'],0,1).'.'.$users[$user]['nom'] ?>
                                       <span class="has-tip[tip-top] has-tip"
                                             data-tooltip aria-haspopup="true"
                                             data-disable-hover="false"
                                             data-options='show_on:medium'
                                             title="{{$c}}"
                                       >
                                      <a href="{{route('mkviewer',[$user])}}"> {!! substr($users[$user]['prenom'],0,1).'.'.$users[$user]['nom'] !!} </a>
                                    </span>

                               @else
                                   <?php $c = 'Voir les incidents de Inconnu ('.$user.')' ?>
                                       <span class="has-tip[tip-top] has-tip"
                                             data-tooltip aria-haspopup="true"
                                             data-disable-hover="false"
                                             data-options='show_on:medium'
                                             title="{{$c}}"
                                       >
                                      <a href="{{route('mkviewer',[$user])}}">  Inconnu ({!! $user !!}) </a>
                                    </span>

                               @endif
                           </td>

                            <td class="center">
                               {!! count($table['incident'][$user]) !!}
                            </td>



                        </tr>
                    @endforeach
                @endif


                </tbody>

            </table>

        </div>

        <div class="small-12 medium-12 large-8 column">

        <table class="table-scroll ">
            <thead>

                <tr>
                    <th ><i class="fa fa-bell dk"></i> </th>
                    <th> <i class="fa fa-angle-right"></i></th>
                    <th ><i class="fa fa-folder-open"></i> </th>
                    <th class="show-for-medium" >Client</th>
                    <th >Titre</th>
                    <th class="show-for-medium" >Bl</th>
                    <th class="show-for-medium" >Update</th>

                </tr>

            </thead>
            <tbody class="fts_090">
            @if(isset($incidents))
                 @foreach($incidents as $kinc => $vincu)
                    <?php
                        $dt = new Carbon\Carbon($vincu->lastact);
                     ?>

                    @if($vincu->level_incid == 1)
                        <tr class="fts_085">
                            <td > <i class="fa fa-bell red fts_110"> </i></td>
                            <td >
                                @if($vincu->id_etat == 1)
                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="En cours">
                                        <i class="fa fa-folder-open pad4 fts_110"></i>
                                    </span>
                                @elseif($vincu->id_etat == 2)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="A rappeler ">
                                       <i class="fa fa-whatsapp pad4 fts_110"></i>
                                    </span>

                                @elseif($vincu->id_etat == 3)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Attente d'info du client">
                                        <i class="fa fa-info-circle pad4 fts_110"></i>
                                    </span>
                                @elseif($vincu->id_etat == 4)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="4">
                                       <span class="pad4 ">?</span>
                                    </span>

                                @elseif($vincu->id_etat == 5)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Expedition materiel">
                                        <i class="fa fa-paper-plane pad4 fts_110"></i>
                                    </span>

                                @elseif($vincu->id_etat == 6)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Attente materiel du client ">
                                        <i class="fa fa-archive fts_110"></i>
                                    </span>
                                @elseif($vincu->id_etat == 7)

                                     <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Pour reparation">
                                         <i class="fa fa-wrench fts_110"></i>
                                     </span>
                                @endif
                            </td>
                            <td><a href="{{route('incident.show',$vincu->id_incid)}}"> {{$vincu->id_incid}} </a></td>
                            <td width="150" class="show-for-medium">{{ (substr($vincu->nsoc,0,20))}} <br/>
                                <span class="fts_075">
                                    <u>{{$vincu->cp}}</u> {{ substr($vincu->ville,0,20)}}
                                </span>
                            </td>
                            <td >{{ ucfirst(strtolower($vincu->titre))}}</td>



                            <td class="show-for-medium"  class="center">@if( $vincu->id_cmd == 'no cmd') - @else{{ $vincu->id_cmd}} @endif</td>
                            <td class="show-for-medium" style="width: 120px" >
                               {{ $dt->format('d-m-Y')}}<br/>à {{ substr($vincu->lastact,10,6)}}
                            </td>
                        </tr>

                    @else
                        <tr class="fts_085">
                            <td> <i class="fa fa-bell dk fts_110" ></i> </td>
                            <td >
                                @if($vincu->id_etat == 1)
                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="En cours">
                                        <i class="fa fa-folder-open pad4"></i>
                                    </span>
                                @elseif($vincu->id_etat == 2)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="A rappeler ">
                                       <i class="fa fa-whatsapp pad4"></i>
                                    </span>

                                @elseif($vincu->id_etat == 3)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Attente d'info du client">
                                        <i class="fa fa-info-circle pad4"></i>
                                    </span>
                                @elseif($vincu->id_etat == 4)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="4">
                                       <span class="pad4">?</span>
                                    </span>

                                @elseif($vincu->id_etat == 5)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Expedition materiel">
                                        <i class="fa fa-paper-plane pad4"></i>
                                    </span>

                                @elseif($vincu->id_etat == 6)

                                    <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Attente materiel du client ">
                                        <i class="fa fa-archive"></i>
                                    </span>
                                @elseif($vincu->id_etat == 7)

                                     <span class="has-tip[tip-top] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Pour reparation">
                                         <i class="fa fa-wrench"></i>
                                     </span>
                                @endif
                            </td>

                            <td><a href="{{route('incident.show',$vincu->id_incid)}}"> {{$vincu->id_incid}} </a></td>

                            <td width="150" class="show-for-medium ">{{ (substr($vincu->nsoc,0,20))}} <br/>
                                <span class="fts_075">
                                    <u>{{$vincu->cp}}</u> {{ substr($vincu->ville,0,15)}}
                                </span>
                            </td>
                            <td class="">{{ ucfirst(strtolower($vincu->titre))}}</td>


                            <td class="show-for-medium center">@if( $vincu->id_cmd == 'no cmd') - @else{{ $vincu->id_cmd}} @endif</td>
                            <td class="show-for-medium" style="width: 120px">  {{ $dt->format('d-m-Y')}}<br/>à {{ substr($vincu->lastact,10,6)}}</td>

                        </tr>
                    @endif

                 @endforeach
             @endif
            </tbody>
        </table>

        </div>
    </div>
<hr/>
@stop


