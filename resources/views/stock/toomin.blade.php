
<div class="row bg-info pad3  align-center">
    <div class="column medium-1 bg_red white center padt15 invisible">
        <b>{{$qte}}</b>
    </div>
    <div class="column medium-11">
        <div class="row">
            <div class="column medium-1 align-middle center">
                @if(isset($achats[$nom_article]))
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x yellow"></i>
                        <i class="fa fa-dollar fa-stack-1x fa-inverse"></i>
                    </span>
                @else
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-dollar fa-stack-1x"></i>
                        <i class="fa fa-ban fa-stack-2x red"></i>
                    </span>
                @endif
            </div>
            <div class="column medium-11">

                <div class="row">
                    <div class="column medium-12  "><b class="">
                            <i class="fa fa-exclamation-triangle red"> </i>
                            &nbsp;
                            <b class="red">{{$count}}/{{$qte}}</b>
                            &nbsp;
                            {{$nom_article}}
                        </b>&nbsp;-
                        {{isset($stockReel['desc'][$nom_article]) ? $stockReel['desc'][$nom_article] : 'Sans déscription' }}
                    </div>
                </div>

                <div class="row ">
                    <div class="column medium-12 ">

                        <i class="fa fa-archive"> </i>&nbsp;Stock -
                        <i class="fa fa-square green"> </i> {{$neuf}} -
                        <i class="fa fa-square yellow"> </i> {{$occase}} -
                        <i class="fa fa-square violet"> </i> {{$reco}} -
                        <i class="fa fa-square red"> </i> {{$hs}}
                    </div>
                </div>

                <div class="row">
                    <div class="column menium-12">
                        <i class="fa fa-clock-o"> </i> &nbsp;Historique
                         {{ isset($sorties[$nom_article]['years']) ? count($sorties[$nom_article]['years']): 0 }}
                        / {{ isset($sorties[$nom_article]['sixMonth']) ? count($sorties[$nom_article]['sixMonth']): 0 }}
                        / {{ isset($sorties[$nom_article]['oneMonth']) ? count($sorties[$nom_article]['oneMonth']): 0 }}
                    </div>
                </div>


                <div class="row">
                    <div class="column menium-12">
                        <i class="fa fa-envelope"> </i> &nbsp;Commentaire:
                        {{$stockMini[$nom_article]->first()->comment}}
                    </div>
                </div>


            </div>


        </div>
    </div>
</div>