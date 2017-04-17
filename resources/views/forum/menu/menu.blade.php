<br>
<div class="row bgW hide-for-print">
    <div class="column ">
        <a href="{{action('ChannelController@create')}}"><h5 class="googleR"> <i class="fa fa-clock-o"></i> Channels</h5></a>
    </div>
    <hr>
</div>
@if(isset($channels))
    @foreach($channels as $index => $channel)
        <a class="hide-for-print" href={{action('ThreadController@index',[$channel->id])}} >
            <div class="row padb15 align-middle  googleR bgW listInc fts_065">
                <div class="column">
                    <i class="fa fa-angle-right"></i>    {{$channel->name}}
                </div>
            </div>
        </a>
    @endforeach
@endif
<div class="row SousContent hide-for-print">
    <div class="medium-12 column ">

    </div>
</div>
<br>
<div class="row bgW hide-for-print">
    <div class="column ">
        <h5 class="googleR"> <i class="fa fa-clock-o"></i> Favoris</h5>
    </div>

</div>
<br>
<div class="row bgW hide-for-print">
    <div class="column ">
        <h5 class="googleR"> <i class="fa fa-clock-o"></i> Historique</h5>
    </div>
    <hr>
</div>
