<br>
<div class="row hide-for-print">
    <div class="column ">
        <h5 class="googleR"> <i class="fa fa-star"></i> Preference</h5>
    </div>
    <hr>
</div>
<div class="row SousContent hide-for-print">
    <div class="medium-12 column ">
        @if(isset($emplacement))
            @foreach ($emplacement->chunk(3) as $chunk)
                <div class="row ContainerMachineLocator">
                    @foreach ($chunk as $v)
                        <a class="column ContainerMachineLoc bgw center"
                           href="{{action('locatorController@show',[$v])}}">
                            <span class="bdd">{{ substr(strtoupper($v),0,4) }} </span></a>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</div>
<br>
<div class="row bgW hide-for-print">
    <div class="column ">
        <h5 class="googleR"> <i class="fa fa-clock-o"></i> Historique</h5>
    </div>
    <hr>
</div>
@if(isset($timelineData))
    @foreach($timelineData as $index => $value)
        <a class="hide-for-print" href={{action('locatorController@forceInput',[$index])}} >
            <div class="row padb15 align-middle  googleR bgW listInc fts_065">
                <div class="column">
                    <i class="fa fa-angle-right"></i>    {{$value['read']}}
                </div>
            </div>
        </a>
    @endforeach
@endif