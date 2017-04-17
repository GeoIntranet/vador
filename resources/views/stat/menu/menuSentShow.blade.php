<div class="column large-12 small-12 medium-12">
    @if($bls <> NULL)
        @foreach($bls as $bl => $cli)
            <a href="{{route('showBlInteger',['bl' => $bl,'l' => 0])}}">
                <div class="row fts_080 padt15 padb15 align-middle listInc googleR">
                    <div class="medium-12 column"> <i class="fa fa-angle-right"></i>  {{$bl}} </div>
                    <div class="medium-12 column">@if(isset($clients[$cli])){{$clients[$cli]}} @else Client inconnu({{$cli}}) @endif</div>
                </div>
            </a>
        @endforeach
    @endif
</div>
