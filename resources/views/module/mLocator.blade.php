 <?php $m =$module['mLocator'] ;?>

<div class="row">
    <div class="medium-12 column ">
        <div class="row pad7">

            <div class="medium-12 columns mContainer">

                <div class="row mTitle align-middle">

                    <div class=" medium-10 column  left">
                       <span class="InlineBlock"><i class="fa fa-truck orange"></i></span>
                       <span class="InlineBlock blk"><h5><b class="orange">L</b>ocator</h5></span>
                    </div>
                    @include('module.mSettingLocator')

                </div>


                <div class="row mContent">
                    <div class="column medium-12 small_12 large-12">

                        <div class="row">

                            <div class="column medium-12 small-12 large-12  ">

                                <div class="row">
                                    <div class=" column medium-12 left SoustitreBox">
                                       </i> <h6 class="dk b">Emplacement Favoris</h6>
                                    </div>
                                </div>


                                @if(isset($m['emplacements']))
                                    @if($m['emplacements'][0] != '')
                                        <div class="row SousContent">
                                            <div class="medium-12 column ">
                                                @foreach ($m['emplacements']->chunk(5) as $chunk)
                                                    <div class="row ContainerMachineLoc">
                                                        @foreach ($chunk as $v)
                                                            <a class="column ContainerMachineLoc"
                                                               href="{{action('locatorController@show',[$v])}}">
                                                                <span class="bdd">{{ strtoupper($v) }} </span></a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="row SousContent">
                                            <div class="medium-12 column ">
                                                <h6>Aucun emplacement favoris</h6>
                                            </div>
                                        </div>
                                    @endif
                                @endif


                                <div class="row ">
                                    <div class=" column medium-12 left SoustitreBox">
                                        <h6 class="dk b">Materiel Favoris</h6>
                                    </div>
                                </div>

                                @if(isset($m['machines']))
                                    @if($m['machines'][0] != '')
                                        <div class="row SousContent">
                                            <div class="medium-12 column ">
                                                @foreach ($m['machines']->chunk(5) as $chunk)
                                                    <div class="row ContainerMachineLoc">
                                                        @foreach ($chunk as $v)
                                                            <a class="column ContainerMachineLoc"
                                                               href="//intranet/locator_query.php?f_art={{ strtoupper($v) }}">
                                                                <span class="bdd">{{ strtoupper($v) }} </span></a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="row SousContent">
                                            <div class="medium-12 column ">
                                                <h6>Aucun materiel favoris</h6>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>