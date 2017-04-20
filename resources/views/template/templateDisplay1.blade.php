@section('t')
    board
@stop

<div class=" menu_mrg">
                            <div class="row">
                                <div class="medium-12 column" >
                                    @include('flash.flash')
                                </div>
                            </div>

                             <div class="row padt15 " id="expanded">
                                 <div class="medium-12 large-12 small-12 column">
                                     <div class="row">
                                          <div class="small-12  show-for-small hide-for-large center columns">
                                              @include('module.mContent')
                                          </div>
                                     </div>

                                     <div class="row expanded">
                                          <div class="small-12 medium-6  large-3 center columns ">

                                          {{--//M1--}}
                                          @if(isset($map['M1'])) @include('module.'.$map['M1'])  @endif
                                          {{--//M3--}}
                                              @if(isset($map['M4'])) @include('module.'.$map['M4'])  @endif
                                          </div>

                                          <div class=" small-12  large-6 center  show-for-large columns">
                                            {{--//M2--}}
                                              @if(isset($map['M2'])) @include('module.'.$map['M2'])  @endif
                                          </div>

                                          <div class="small-12 medium-6  large-3 center columns">
                                            {{--//M4--}}
                                              @if(isset($map['M3'])) @include('module.'.$map['M3'])  @endif
                                              {{--//M5--}}
                                              @if(isset($map['M5'])) @include('module.'.$map['M5'])  @endif
                                          </div>
                                     </div>

                                 </div>
                             </div>
                        </div>

                        <div class=" ">
                            <div class="row padt15 " id="expanded_">
                              <div class="medium-12 large-12 column">
                                  <div class="row expanded">
                                       <div class="small-12 medium-12 large-3 center columns ">
                                           @if(isset($map['M6'])) @include('module.'.$map['M6'])  @endif
                                       </div>
                                       <div class="small-12 medium-12 large-9 center columns">
                                           @if(isset($map['M7'])) @include('module.'.$map['M7'])  @endif
                                       </div>
                                  </div>
                              </div>
                          </div>
                        </div>

                        <div class=" padb10">
                            <div class="row padt15">
                              <div class="medium-12 column">
                                  <div class="row">
                                       <div class="small-12 medium-12 large-3 center columns ">
                                            {{--@include('module.mArrive')--}}
                                       </div>
                                       <div class="small-12 medium-12 large-9 center columns">
                                            {{--@include('module.mCrm')--}}
                                       </div>
                                  </div>
                              </div>
                          </div>
                        </div>


                          </div>

                        </div>