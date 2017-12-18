@foreach($incidents->solvable as $presta => $incidents)

    @if($presta == 1)
        <br>
        <br>
        <b> <u> LES GARANTIE SUR VENTES :</u></b>
        @foreach($incidents as $index => $incident)
            <div class="col-lg-3">
                <b>{{$incident->id_incid}}</b>
                -
                {{ ($incident->nsoc) }}
                -
                <small>{!!strtolower($incident->titre)!!}</small>
                -
                <small class="">
                    @php $diff = (new \Carbon\Carbon())->diffInDays( new \Carbon\Carbon($incident->lastact)) @endphp
                    <span>le {{$incident->open->format('d/m')}}</span>
                </small>
            </div>
        @endforeach
    @endif

    @if($presta == 4)
        <br>
        <br>
        <b> <u>HORS GARANTIE : </u></b>
        @foreach($incidents as $index => $incident)
            <div class="col-lg-3">

                <b>{{$incident->id_incid}}</b>
                -
                {{ ($incident->nsoc) }}
                -
                <small>{!! strtolower($incident->titre) !!}</small>
                -
                <small class="">
                    @php $diff = (new \Carbon\Carbon())->diffInDays( new \Carbon\Carbon($incident->lastact)) @endphp
                    <span>le {{$incident->open->format('d/m')}}</span>
                </small>
        @endforeach
    @endif

@endforeach