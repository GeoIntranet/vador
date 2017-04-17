<?php
    $shortcut = $m['Rapidsearch'] ;
?>

<div class="row RapidSearch">
    <div class="medium-12 columns">

        <div class="row">

          @if(isset($shortcut['incidentUserActif']) AND isset($shortcut['incidentNonLu']))
          <?php $inc = 'Vous avez '.$shortcut['incidentUserActif'].' incident en cours  et '.$shortcut['incidentNonLu'].' non lu.'; ?>
          <div class="has-tip[tip-top] has-tip top BoxSearch column"
               data-tooltip aria-haspopup="true"
               data-disable-hover="false"
               data-options='show_on:medium'
               title='{{$inc}}'>
             <a href="{{route('mkviewer', [ 'x'=> $m['user']['id']] )}}">

                 <span class="">

                     @if($shortcut['incidentNonLu'] > 0)
                        <i class="fa fa-warning red"></i>
                     @else <i class="fa fa-warning "></i> @endif


                     @if($shortcut['incidentNonLu'] > 0  )
                        @if($shortcut['incidentNonLu'] > 9)
                            <span class="bubule">
                               <span class="WarningBubule"> {{$shortcut['incidentNonLu']}}</span>
                            </span>
                        @else
                            <span class="bubule">
                               <span class="WarningBubule_"> {{$shortcut['incidentNonLu']}}</span>
                            </span>
                        @endif
                     @endif


                     @if($shortcut['incidentNonLu'] == 0)
                        @if($shortcut['incidentUserActif'] > 0  )
                           @if($shortcut['incidentUserActif'] > 9)
                               <span class="bubule">
                                  <span class="SuccessBubule"> {{$shortcut['incidentUserActif']}}</span>
                               </span>
                           @else
                               <span class="bubule">
                                  <span class="SuccessBubule_"> {{$shortcut['incidentUserActif']}}</span>
                               </span>
                           @endif
                        @endif
                        @else
                     @endif

                 </span>
             </a>
          </div>
          @endif

            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="prise d'appel">
                <a class="" href="//intranet/tel_prise_01.php">
                    <i class="fa fa-phone"></i>
                </a>
            </span>

            @if(isset($shortcut['incidentActif']))
            <?php $ct = $shortcut['incidentActif'].' Incidents ouverts
            ( tout utilisateurs confondus)' ?>
            <div class="has-tip[tip-top] has-tip top BoxSearch column" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title='{!! $ct !!}'>
                <a href="//intranet/recherche_retour.php?id_techcom={{$m['user']['id']}}">
                    <span>
                        <i class="fa fa-bell"></i>
                         @if($shortcut['incidentActif'] > 0)
                               @if($shortcut['incidentActif'] > 9)
                                   @if($shortcut['incidentActif'] > 99)
                                        <span class="bubule">
                                           <span class="StdBubule">99</span>
                                        </span>
                                   @else
                                    <span class="bubule">
                                       <span class="StdBubule"> {{$shortcut['incidentActif']}}</span>
                                    </span>
                                   @endif
                               @else
                                   <span class="bubule">
                                      <span class="StdBubule_"> {{$shortcut['incidentActif']}}</span>
                                   </span>
                               @endif
                         @endif
                    </span>
                </a>
            </div>
            @endif

            @if(isset($shortcut['daEncours']))
            <?php $ct = '- '.$shortcut['daEncours'].' - Demande d\'achats en attentes ' ?>
            <div class="has-tip[tip-top] has-tip top BoxSearch column" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title='{{$ct}}'>
                  <a href="//intranet/po15_voir_demande.php?cat=all">
                    <span>
                        <i class="fa fa-cc-visa"></i>
                         @if($shortcut['daEncours'] > 0)
                               @if($shortcut['daEncours'] > 9)
                                   @if($shortcut['daEncours'] > 99)
                                        <span class="bubule">
                                           <span class="WarningBubule">99</span>
                                        </span>
                                   @else
                                    <span class="bubule">
                                       <span class="WarningBubule"> {{$shortcut['daEncours']}}</span>
                                    </span>
                                   @endif
                               @else
                                   <span class="bubule">
                                      <span class="SuccessBubule_"> {{$shortcut['daEncours']}}</span>
                                   </span>
                               @endif
                         @endif
                    </span>
                </a>
            </div>
            @endif

            @if(isset($u['retour']))
            <?php $ct = '- '.$u['retour'].' - retours en attentes ' ?>
            <div class="has-tip[tip-top] has-tip top BoxSearch column" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title='{{$ct}}'>
                <a href="//intranet/recherche_retour.php?id_techcom={{$m['user']['id']}}">
                    <span>
                        <i class="fa fa-mail-reply-all "></i>
                        @if($u['retour'] > 0)
                              @if($u['retour'] > 9)
                                  @if($u['retour'] > 99)
                                       <span class="bubule">
                                          <span class="WarningBubule">99</span>
                                       </span>
                                  @else
                                   <span class="bubule">
                                      <span class="WarningBubule"> {{$u['retour']}}</span>
                                   </span>
                                  @endif

                              @else
                                  <span class="bubule">
                                     <span class="WarningBubule_"> {{$u['retour']}}</span>
                                  </span>
                              @endif
                        @endif
                    </span>
                </a>
            </div>
            @endif

            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="Locator">
                <a href="{{action('locatorController@noSession')}}">
                    <i class="fa fa-truck"></i>
                </a>
            </span>

            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="Catalogue">
                <a href="//intranet/locator_catalogue.php">
                    <i class="fa fa-book"></i>
                </a>
            </span>

            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="Info technique">
                <a href="//intranet/info_tech_it.php">
                    <i class="fa fa-mortar-board"></i>
                </a>
            </span>

        </div>

        <div class="row ">

            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="CRM">
                <a href="">
                    <span class="fa-stack fa-lg fts_100">
                      <i class="fa fa-square fa-stack-2x"></i>
                      <i class="fa fa-suitcase fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </span>

            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="Action CRM">
                <a href="">
                    <i class="fa fa-folder-open"></i>
                </a>
            </span>

            @if(isset($shortcut['dpEncours']))
            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="Demande de prix">
                <a href="//intranet/recherche_retour.php?id_techcom={{$m['user']['id']}}">
                    <span>
                         @if( $shortcut['dpEncours'] > 0 AND $shortcut['dpEncours'] < 9)
                            <i class="fa fa-calculator "></i>
                             <span class="bubule">
                                <span class="WarningBubule_"> {{$shortcut['dpEncours']}}</span>
                             </span>
                         @elseif( $shortcut['dpEncours'] > 9)
                            <i class="fa fa-calculator "></i>
                            <span class="bubule">
                               <span class="WarningBubule"> {{$shortcut['dpEncours']}}</span>
                            </span>
                         @else
                            <i class="fa fa-calculator "></i>
                         @endif
                    </span>
                </a>
            </span>
            @endif

            @if(isset($shortcut['actionEncours']))
                <?php $ct = '- '.$shortcut['actionEncours']. ' - actions en retard' ?>
            <div class="has-tip[tip-top] has-tip top BoxSearch column" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title='{{$ct}}'>
                <a href="//intranet/recherche_retour.php?id_techcom={{$m['user']['id']}}">
                    <span>
                         <i class="fa fa-bomb "></i>

                         @if($shortcut['actionEncours'] > 0)
                               @if($shortcut['actionEncours'] > 9)
                                   @if($shortcut['actionEncours'] > 99)
                                        <span class="bubule">
                                           <span class="WarningBubule">99</span>
                                        </span>
                                   @else
                                    <span class="bubule">
                                       <span class="WarningBubule"> {{$shortcut['actionEncours']}}</span>
                                    </span>
                                   @endif
                               @else
                                   <span class="bubule">
                                      <span class="WarningBubule"> {{$shortcut['actionEncours']}}</span>
                                   </span>
                               @endif
                         @endif
                    </span>
                </a>
            </div>
            @endif

            @if(isset($shortcut['commandeEncours']))
                <?php $ct = '- '.$shortcut['commandeEncours']. ' - fiches en cours' ?>
            <div class="has-tip[tip-top] has-tip top BoxSearch column" data-tooltip aria-haspopup="true" data-disable-hover="false" data-options='show_on:medium' title='{{$ct}}'>
                <a href="//intranet/recherche_retour.php?id_techcom={{$m['user']['id']}}">
                    <span>
                         <i class="fa fa-file-o "></i>

                         @if($shortcut['commandeEncours'] > 0)
                               @if($shortcut['commandeEncours'] > 9)
                                   @if($shortcut['commandeEncours'] > 99)
                                        <span class="bubule">
                                           <span class="StdBubule">99</span>
                                        </span>
                                   @else
                                    <span class="bubule">
                                       <span class="StdBubule"> {{$shortcut['commandeEncours']}}</span>
                                    </span>
                                   @endif
                               @else
                                   <span class="bubule">
                                      <span class="StdBubule"> {{$shortcut['commandeEncours']}}</span>
                                   </span>
                               @endif
                         @endif
                    </span>
                </a>
            </div>
            @endif

            <span data-tooltip aria-haspopup="true" class="has-tip top BoxSearch column" data-disable-hover="false" tabindex="2" title="Site web">
                <a href="">
                        <i class="fa fa-globe"></i>
                </a>
            </span>


        </div>

    </div>
</div>