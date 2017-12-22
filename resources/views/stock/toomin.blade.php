<div class="row bg-info pad3 border align-center">
    <div class="column medium-1 bg_red white center padt15">
        <b>{{$qte}}</b>
    </div>
    <div class="column medium-11">
        <div class="row">
            <div class="column medium-1 align-middle center">
                @if(isset($achats[$index]))
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
                    <div class="column medium-12 border "><b class="red">{{$index}}</b> - {{$stock['desc'][$index]}}
                        - {{ isset($sortie['years']) ? count($sortie['years']): 0 }}
                        / {{ isset($sortie['sixMonth']) ? count($sortie['sixMonth']): 0 }}
                        / {{ isset($sortie['oneMonth']) ? count($sortie['oneMonth']): 0 }}
                    </div>
                </div>

                <div class="row ">
                    <div class="column medium-12 border">
                        <?php $count = 0; ?>
                        Stock Actuel -
                        <i class="fa fa-square green"> </i> {{$neuf}} -
                        <i class="fa fa-square yellow"> </i> {{$occase}} -
                        <i class="fa fa-square violet"> </i> {{$reco}} -
                        <i class="fa fa-square red"> </i> {{$hs}}

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>