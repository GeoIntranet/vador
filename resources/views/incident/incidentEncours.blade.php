@extends('templateModule')


@section('t')
    Incidents - en cours
@stop


@section('content')
<br/>

    <div class="row ">

        <div class="medium-8 column">
            <h2 class="googleB">Incident en cours</h2>
        </div>

        <div class="medium-4 column">
            <h2 class="googleB dark">Derniers  <small class="dark">consultés</small></h2>
        </div>

    </div>

    <div class="row ">

        <div class="medium-12 small-12 large-8 column">
            <table>
                <thead>
                    <tr class=" fts_110">
                       <th class="">
                            <i class="fa fa-angle-right dk pad4"></i>
                       </th>

                       <th>
                            <i class="fa fa-phone pad4"></i>
                       </th>

                        <th class="">
                             <i class="fa fa-bell pad4"></i>
                        </th>

                       <th class="">
                              <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="En cours">
                                <i class="fa fa-folder-open pad4"></i>
                            </span>
                       </th>



                       <th>
                            <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="A rappeler">
                                <i class="fa fa-whatsapp pad4"></i>
                            </span>
                       </th>

                       <th>

                             <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Attente d'info du client">
                                <i class="fa fa-info-circle pad4"></i>
                            </span>

                       </th>

                       <th>
                            <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="materiel neuf">
                                <i class="fa fa-star pad4"></i>
                            </span>
                       </th>

                       <th>

                            <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Expedition machine">
                               <span class="pad4 fa fa-truck "></span>
                            </span>

                       </th>

                       <th>

                          <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Attente materiel du client ">
                                <i class="fa fa-archive"></i>
                            </span>

                       </th>

                       <th>
                            <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Pour reparation">
                                <i class="fa fa-wrench"></i>
                            </span>
                       </th>

                       <th>
                            <span class="has-tip[tip-bottom] has-tip  " data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title="Attente fournisseur">
                                <i class="fa fa-plane"></i>
                            </span>
                       </th>

                    </tr>
                </thead>

                <tbody class="fts_090">
                    @foreach($table as $index => $value)
                        <tr>
                            <td class="center"><i class="fa fa-angle-right dk"></i></td>
                            <td class="center fts_085">
                                @if(isset($user[$index]))
                                    <a href="{{route('mkviewer',[$index])}}">{!! $user[$index]['prenom'] .' '. $user[$index]['nom'].' ('. $index.')' !!}</a>
                                @else
                                    <a href="{{route('mkviewer',[$index])}}">{!! 'Inconnu ('. $index.')' !!}</a>
                                @endif
                            </td>
                            <td class="center">
                                @if( isset($warning[$index]))
                                    <i class="fa fa-bell red"></i>
                                @else
                                    <i class="fa fa-bell "></i>
                                @endif
                            </td>
                            @for($i=1; $i <= 8 ; $i++ )
                                <td class="center">
                                   @if( isset( $value[$i] ))
                                       <b>{!! $value[$i] !!}</b>
                                   @else
                                       0
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


        <div class="medium-12 small-12 large-4 column ">

            <table>
                <thead>
                    <tr>
                        <th><i class="fa fa-folder-open"></i> </th>
                        <th>Client</th>
                        <th>Titre</th>

                    </tr>
                </thead>
                <tbody class="fts_075">
                @if(isset($incidents) and count($incidents) !== 0 and $incidents <>'')
                    @foreach($incidents as $indexIncident => $incident)
                        <tr class="">
                            <td class="listInc googleR">
                                @if($incident->level_incid == 1)
                                    <i class="fa fa-bell red"></i>&nbsp
                                @else
                                    <i class="fa fa-bell "></i>&nbsp
                                @endif
                                <a href="{{route('incident.show',$incident->id_incid)}}">{{ $incident->id_incid}}  </a>
                            </td>
                            <td class="listInc googleR">{!! ucfirst((substr($incident->nsoc,0,12))) !!} </td>
                            <td class="listInc googleR">{!! substr($incident->titre,0,20) !!} </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td  class="center" colspan="3">Aucun incident chez vous</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
<hr/>
@stop


