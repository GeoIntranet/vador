
@if(Session::has('noExist'))
    <div class=" sms mError">
        {!! Session::get('noExist') !!}
    </div>
@endif

@if(Session::has('AutoCumule'))
    <div class=" sms mSucess">
        {!! Session::get('AutoCumule') !!}
    </div>
@endif

@if(Session::has('userNoExist'))
    <div class=" sms mError">
        {!! Session::get('userNoExist') !!}
    </div>
@endif

@if(Session::has('noAdmin'))
    <div class=" sms mError">
        {!! Session::get('noAdmin') !!}
    </div>
@endif


@if(Session::has('EmptyAbsInfo'))
    <div class=" sms mError">
        {!! Session::get('EmptyAbsInfo') !!}
    </div>
@endif

@if(Session::has('errorUser'))
    <div class=" sms mError">
        {!! Session::get('errorUser') !!}
    </div>
@endif

@if(Session::has('NoHoraire'))
    <div class=" sms mError">
        {!! Session::get('NoHoraire') !!}
    </div>
@endif

@if(Session::has('SuccessUpdateHoraire'))
    <div class=" sms mError">
        {!! Session::get('SuccessUpdateHoraire') !!}
    </div>
@endif

@if(Session::has('SucessHorraire'))
    <div class=" sms mSucess">
        {!! Session::get('SucessHorraire') !!}
    </div>
@endif

@if(Session::has('NoTemplate'))
    <div class="warn wError ">
        {!! Session::get('NoTemplate') !!}
    </div>
    <hr/>
@endif

@if(Session::has('TemplateDoublon'))
    <div class="warn wError ">
        {!! Session::get('TemplateDoublon') !!}
    </div>
    <hr/>
@endif

@if(Session::has('TemplateCreate'))
     <div class="callout sms mSucess " data-closable>
                <div class="row ">
                    <div class="medium-12 column brdSucess">
                        <p class="b"> <i class="fa fa-gear"></i> &nbsp MESSAGE SYSTEME &nbsp &#8212 &nbsp INFORMATIF</p>
                    </div>
                </div>
                <div class="row pad10 align-bottom">
                    <div class="medium-8 column fts_110">
                        <p>
                            {!! Session::get('TemplateCreate') !!}
                        </p>
                    </div>
                </div>

             <button class="close-button white" aria-label="Dismiss alert" type="button" data-close>
               <span aria-hidden="true">&times;</span>
             </button>
        </div>

@endif

@if(Session::has('ReminderMail'))
     <div class="callout sms mSucess " data-closable>
                <div class="row expanded">
                    <div class="medium-12 column brdSucess">
                        <p class="b"> <i class="fa fa-gear"></i> &nbsp MESSAGE SYSTEME &nbsp &#8212 &nbsp INFORMATIF</p>
                    </div>
                </div>
                <div class="row pad10 align-bottom expanded">
                    <div class="medium-12 column fts_110">
                        <p>
                           Email envoyer à :
                           <br/>
                           <br/>
                           @foreach( collect(Session::get('ReminderMail'))->chunk(3) as $k)
                           <span class="row expanded ">
                                @foreach($k as $kk => $vv)

                                    <span class="medium-4 column ">
                                        <span class="emp">{{$kk}} {{$vv['prenom']}}</span> : {{ $vv['email']}}
                                    </span>

                                @endforeach
                           </span>


                           @endforeach
                        </p>
                    </div>
                </div>

             <button class="close-button white" aria-label="Dismiss alert" type="button" data-close>
               <span aria-hidden="true">&times;</span>
             </button>
        </div>

@endif

@if(Session::has('TemplateUpdate'))

    <div class="callout sms mSucess " data-closable>
            <div class="row ">
                <div class="medium-12 column brdSucess">
                    <p class="b"> <i class="fa fa-gear"></i> &nbsp MESSAGE SYSTEME &nbsp &#8212 &nbsp INFORMATIF</p>
                </div>
            </div>
            <div class="row pad10 align-bottom">
                <div class="medium-8 column fts_110">
                    <p>
                        {!! Session::get('TemplateUpdate') !!}
                    </p>
                </div>
            </div>

         <button class="close-button white" aria-label="Dismiss alert" type="button" data-close>
           <span aria-hidden="true">&times;</span>
         </button>
    </div>

@endif

@if(Session::has('NoArchitecture'))

   <div class="callout sms mError fts_080" data-closable>

        <div class="row">
            <div class="medium-12 column">
                <p class="b"> <i class="fa fa-gear"></i> &nbsp MESSAGE SYSTEME &nbsp &#8212 &nbsp INFORMATIF</p>
            </div>
        </div>

         <hr class="sm "/>

        <div class="row align-middle">

            <div class="medium-8 column">
                <p>
                  <u>@if(isset($u['user']->USER_prenom)){{ $u['user']->USER_prenom}}</u> , Tu @else Tu @endif n'as pas encore personalisé ton espace de travail !
                  Pour accéder aux paramètres il te suffit d'aller <a class="b white emp" href={{route('templateChoice')}}>ici</a>
                </p>
                <p>
                     Pas d'inquiètude, si tu n'as pas le temps <span class="emp"> maintenant </span>,
                     tu pourra a tout moment , configurer ton plan de travail .<br>
                     Pour se faire, il te suffira d 'aller dans le menu
                    &#8212 <b class="emp">&nbsp<i class="fa fa-angle-right"></i> &nbsp Utilitaire &nbsp<i class="fa fa-angle-right"></i> &nbsp Gestion de votre compte</b>

                </p>
                <p>
                    Tu peut me faire disparaitre en cliquant sur la croix !
                    Ce message informatif apparaitra une fois par jours pendant 10j .
                    A bientot !
                </p>


            </div>
            <div class="medium-4 column center">
                <i class="fa fa-gear fts_600 opa3"></i>
            </div>

        </div>

     <button class="close-button white" aria-label="Dismiss alert" type="button" data-close>
       <span aria-hidden="true">&times;</span>
     </button>

   </div>



@endif