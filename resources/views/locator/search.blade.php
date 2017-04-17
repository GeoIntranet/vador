{!! Form::open(['url' => action('locatorController@search',$id), 'class' => '']) !!}
<div class="row pad10 hide-for-print">
    <div class="column bgW ">
        <div class="row align-middle pad5">
            <div class="column medium-1 fts_150 center ">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x blue"></i>
                  <i class="fa fa-search fa-stack-1x fa-inverse"></i>
                </span>
            </div>
            <div class="column medium-2 ">
                <div class="row">
                    <div class="column medium-12 left "><h4 class="googleB">Recherche</h4></div>
                </div>
            </div>
            <div class="column medium-9 ">
                <div class="row ">
                    <div class="column medium-12 right">
                        {!! Form::text('general', '', ['placeholder'=>'Filtre general','class' => 'locatorInput']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-middle pad5">

            <div class="column ">
                ID
                {!! Form::text('id', isset($session) ? $session['id'] : '', ['placeholder'=> 'id185167','class' => 'LocatorInput th']) !!}
            </div>
            <div class="column ">
                Emplacement
                {!! Form::text('emplacement', isset($session) ? $session['emplacement'] : $id, ['placeholder'=> 'e403','class' => 'LocatorInput th']) !!}
            </div>

            <div class="column ">
                Articles
                {!! Form::text('article', isset($session['article']) ? $session['article'] : '', ['placeholder'=> 'PM4I','class' => 'LocatorInput th']) !!}
            </div>
            <div class="column ">
                Description
                {!! Form::text('description', isset($session['description']) ? $session['description'] : '', ['placeholder'=> '300dpi','class' => 'LocatorInput th']) !!}
            </div>
        </div>

        <div class="row">

            <div class="column">
                <label>
                    {!! Form::checkbox('1', 1,isset($session['1']) ? $session['1'] : 0) !!}
                    <i class="fa fa-square fa-2x green"></i>
                    @if(isset($counter['count'][1])) <b>( {{$counter['count'][1]}} )</b>
                    @else <b>( 0 )</b>
                    @endif
                </label>
            </div>

            <div class="column">
                <label>
                    {!! Form::checkbox('11', 1,isset($session['11']) ? $session['11'] : 0) !!}
                    <i class="fa fa-square fa-2x yellow"></i>
                    @if(isset($counter['count'][11])) <b>( {{$counter['count'][11]}} )</b>
                    @else <b>( 0 )</b>
                    @endif
                </label>
            </div>
            <div class="column">
                <label>
                    {!! Form::checkbox('21', 1,isset($session['21']) ? $session['21'] : 0) !!}
                    <i class="fa fa-square fa-2x violet"></i>
                    @if(isset($counter['count'][21])) <b>( {{$counter['count'][21]}} )</b>
                    @else <b>( 0 )</b>
                    @endif
                </label>
            </div>

            <div class="column">
                <label>
                    {!! Form::checkbox('22', 1, isset($session['22']) ? $session['22'] : 0) !!}
                    <i class="fa fa-square fa-2x red"></i>

                    @if(isset($counter['count'][22])) <b>( {{$counter['count'][22]}} )</b>
                    @else <b>( 0 )</b>
                    @endif

                </label>
            </div>




        </div>

        <div class="row">

            <div class="column">
                <label>
                    {!! Form::checkbox('out',1, isset($session['out']) ? $session['out'] : 0) !!}
                    <i class="fa fa-archive fa-2x"></i> <b>Inclure les sorties</b>
                </label>
            </div>


            <div class="column">
                <label>
                    {{ Form::checkbox('0', 1, isset($session['0']) ? $session['0'] : 0 ) }}
                    <i class="fa fa-question-circle fa-2x"></i> <b>A audité
                        @if(isset($counter['count'][0])) ( {{$counter['count'][0]}} )
                        @else()
                            ( 0 )
                        @endif
                    </b>
                </label>
            </div>

            <div class="column  right">
                {!! Form::submit('Recherche', ['class' => 'button blue ']) !!}
            </div>

        </div>

        <br>

    </div>
</div>
{!! Form::close() !!}