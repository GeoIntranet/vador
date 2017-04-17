<div class="column bgW pad10" id="">


    {!! Form::open(['url' => action('locatorController@filtreStoreArticle'), 'class' => 'form-horizontal']) !!}
        {{ csrf_field() }}
        <div class="row align-middle ">
            <div class="colum medium-2 "> <h6><i class="fa fa-wrench"></i> Article</h6></div>
            <div class="column medium-10 ">
                <div class="row align-top">
                    <div class="column medium-9 right ">
                        {!! Form::text('art_search', old('art_search') ? session()->get('art_search') : $locator->id->article, ['class' => 'LocatorInput','placeholder' => 'Model a filtrer']) !!}
                    </div>
                    <div class="column medium-3  left">
                    {!! Form::submit('Filtre', ['class' => 'button blue']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

                {!! Form::open(['url' => action('locatorController@store'), 'class' => 'form-horizontal']) !!}
                {{ csrf_field() }}
                {!! Form::hidden('id', $locator->id->id_locator, ['id' => 'id']) !!}
                {!! Form::hidden('art_perma', $locator->id->article, ['id' => 'id']) !!}

                <div class="row align-middle">
                    <div class="column medium-12 ">
                        @if(session()->get('models') <> null)
                            {!! Form::select('art_list', session()->get('models') , $locator->id->article , ['class' => 'locatorInput']) !!}
                        @endif
                    </div>

                </div>
            </div>
        </div>

    <div class="row ">
        <div class="colum medium-2 "> <h6> <i class="fa fa-file"></i> Description</h6></div>
        <div class="column medium-10">

            <div class="row align-middle">
                <div class="column medium-12 ">
                    <?php
                       $text = br2nl($locator->id->description);
                    ?>
                    {!! Form::textarea('description', $text, ['class' => 'LocatorInput','rows'=>'10']) !!}
                </div>

            </div>
        </div>
    </div>

    <div class="row align-middle">
        <div class="colum medium-2 "> <h6>Etat</h6></div>
        <div class="column medium-10 ">
            <div class="row align-middle">
                <div class="column medium-4 ">
                    <?php
                        $etats = collect($locator->etat);
                        $current = $locator->etat[$locator->id->id_etat];
                        $etats = $etats->forget($locator->id->id_etat);
                    ?>

                        <select name="etat" id="etat">
                            <option value="{{$locator->id->id_etat}}" selected='selected'  >{{$current}}</option>
                            @foreach($etats as $index_etat => $etat)
                                <option value="{{$index_etat}}">{{$etat}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="column medium-8 fts_080">
                    Audité par <u>{{$locator->whoAudit}}</u> le <i>{{$locator->whenAudit}}</i>
                </div>
                @if($locator->isAudit)
                    @if($locator->isHs)
                        <div class="column medium-4  center">
                            <i class="fa fa-times red"></i> Non-conforme
                        </div>
                    @else

                    @endif

                @else
                    <div class="column medium-4  center">
                        <label>
                            {!! Form::checkbox('hs', '1', null,  ['id' => 'name']) !!}
                            Non conforme a l'achat
                        </label>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="row align-middle fts_085">
        <div class="colum medium-2 "> <h6> <i class="fa fa-barcode"></i> SN</h6></div>
        <div class="column medium-10 ">
            <div class="row align-middle">
                <div class="column medium-12 ">
                    {!! Form::text('num_serie', $locator->id->num_serie, ['class' => 'LocatorInput','placeholder' => 'Numéro de serie']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row align-middle fts_085">
        <div class="colum medium-2 "> <h6> <i class="fa fa-user"></i> Fournisseur</h6></div>
        <div class="column medium-10 ">
            <div class="row align-middle">
                <div class="column medium-12 ">
                    {{$locator->id->in_fournisseur}} - Receptionné par {{$locator->whoIn}} le {{$locator->whenIn}}
                </div>
            </div>
        </div>
    </div>

    <div class="row align-middle fts_085">
        <div class="colum medium-2 "> <h6> <i class="fa fa-car"></i> Transport</h6></div>
        <div class="column medium-10 ">
            <div class="row align-middle">
                <div class="column medium-12 ">
                    {{$locator->id->in_transport}}
                </div>
            </div>
        </div>
    </div>

    <div class="row align-middle fts_085">
        <div class="colum medium-2"> <h6> <i class="fa fa-briefcase"></i> Prestation</h6></div>
        <div class="column medium-10">
            <div class="row align-middle">
                <div class="column medium-12 ">
                    {{$locator->id->in_presta}}
                </div>
            </div>
        </div>
    </div>

    <div class="row align-middle ">
        <div class="colum medium-2"> <h6> <i class="fa fa-table"></i> Locator</h6></div>
        <div class="column medium-10">
            <div class="row align-middle">
                <div class="column medium-12 ">
                    <select name="locator" id="myselect">
                        <option value="{{$locator->id->locator}}" selected='selected'  >{{$locator->id->locator}}</option>
                        @foreach($locator->emplacements as $idloc => $loc)
                            <option value="{{$loc}}">{{$loc}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>



    <br>
    <div class="row">
        <div class="column right">
            {!! Form::submit('Envoyé', ['class' => 'button blue']) !!}
        </div>
    </div>

    {!! Form::close() !!}
</div>