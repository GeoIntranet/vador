@extends('...layouts.app')

@section('content')
<br/>
<br/>
<div class="row"><h2><?php echo " &nbsp; "; ?></h2></div>
<div class="row ">


    <div class="medium-4 column center ">
        	<div class="CADRE_W ">
        	<div class="KEY "><img src="{{asset('imgs/key_inc1.png')}}" alt="" /></div>
        		<div class="CADRE">

        		    <div class="row center marron">
        		        <div class="medium-offset-1 medium-11 column left">
        		             <h3><b>LOGIN  </b></h3>
        		        </div>
        		    </div>

        		    <div class="row">
				        <div class="medium-offset-1 medium-9 column ">

							<div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                    {!! csrf_field() !!}

                                    <div class="input-group">
                                      <span class="input-group-label"><i class="fa fa-envelope dk"></i></span>
                                      <input class="input-group-field" type="email"  name="email" value="{{ old('email') }}">


                                    </div>


                                    <div class="input-group">
                                      <span class="input-group-label"><i class="fa fa-key dk"></i></span>
                                      <input class="input-group-field" type="password" name="password">
                                    </div>



                                    <div class="row">
                                        <div class="medium-12 column fts_070 red b">
                                            @if ($errors->has('email'))
                                                <strong>{{ $errors->first('email') }}</strong>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="medium-6 column">
                                            <div class="form-group  left">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" checked> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="medium-6 column">
                                            <div class="form-group ">
                                                <button type="submit" class="btn btn-primary dk">
                                                    <i class="fa fa-btn fa-sign-in"></i> &nbsp Login
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
				        </div>
        			</div>
        		</div>
        	</div>
        </div>



</div>







@endsection
