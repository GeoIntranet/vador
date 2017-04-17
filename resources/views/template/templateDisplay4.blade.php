
                        <div class=" menu_mrg ">
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


                                            <div class="small-12 medium-6  large-6 center columns ">

                                                <div class="row">
                                                    <div class="medium-12 large-6 small-12 column ">
                                                        {{--//M2--}}
                                                        @include('module.'.$k['M1']['nom'])
                                                    </div>
                                                    <div class="medium-12 large-6 small-12 column ">
                                                        {{--//M2--}}
                                                        @include('module.'.$k['M2']['nom'])
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="medium-12 large-6 small-12 column ">
                                                        {{--//M2--}}
                                                        @include('module.'.$k['M4']['nom'])
                                                    </div>
                                                    <div class="medium-12 large-6 small-12 column ">
                                                        {{--//M2--}}
                                                        @include('module.'.$k['M5']['nom'])
                                                    </div>
                                                </div>

                                            </div>


                                            <div class=" small-12 medium-6  large-6 center  show-for-large columns">
                                              {{--//M2--}}
                                              @include('module.'.$k['M3']['nom'])
                                            </div>

                                     </div>

                                 </div>
                             </div>
                        </div>


                            <div class="row padt15 " id="expanded_">
                              <div class="medium-12 large-12 column">
                                  <div class="row expanded">
                                       <div class="small-12 medium-12 large-6 center columns ">
                                            @include('module.'.$k['M6']['nom'])
                                       </div>
                                       <div class="small-12 medium-12 large-6 center columns">
                                            @include('module.'.$k['M7']['nom'])
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