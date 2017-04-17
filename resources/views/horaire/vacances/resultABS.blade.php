<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>DEMANDE D'ABSENCE</title>
<link rel="stylesheet" href="/lab/resources/assets/css/application.css"  media="all"  />
    <style>


        body{
            /*background-image: url('/lab/resources/assets/imgs/croix5.png');*/
            border-right : solid 8px #343434;
            margin : -34;
            font: Helvetica;
            font-size: 0.6em;

        }

        h1 {  font-size: 4rem; }
        h2 { font-size: 3rem; }
        h3 { font-size: 2rem; }
        h4 { font-size: 1.5625rem; }
        h5 { font-size: 1.25rem; }
        h6 { font-size: 1rem; }


        .page-break{page-break-after  :  always;}
         .emplo{
                width: 100%;
             height: 1px;
             border-right: 0;
             border-top: 0;
             border-bottom: 3px dashed #cacaca;
             border-left: 0;
             margin: 10px auto;
             clear: both;
         }

        img{ height: 196px;  width: auto; }


        .border1 { border:solid 1px red; }
        .border2 { border:solid 1px blue; }
        .border3 { border:solid 1px green; }
        .border4 { border:solid 1px black; }

         tr{ margin:0; padding:0; }
         td{ margin:0; padding:0; }
         tbody{ margin:0; padding:0; }
         table{ margin:0; padding:0;border-collapse: collapse; }

        .HEADER {
            background-color: #F1F1F1;
            height: 200px;
            border-left : solid 5px #343434;
            border-bottom : solid 1px #d6d6d6;

        }
        .headerSize{
            font-size: 4em;
            font-weight: bold;
            color: #343434;
        }
        .lightGray{color:#696969;}
        .red{color:indianred;}
        .bodyContent{color:#343434;padding: 0 0 0 20px }
        .bodyTitle{ padding-bottom: 0; }
        .bodySub { color:#696969; }

        .tableABS{

             border:solid 2px #cacaca;
             border-radius: 10px;
              margin-right: 15px;
              margin-left: 15px;
              margin-top: 5px;
              margin-bottom: 5px;
        }

        .tableABS > table {
            width: 100%;
            padding: 10px;



        }

        .tableABS > table >tbody > tr > td { width: auto;}
        .Thead { padding: 5px; border-bottom: solid 2px #cacaca; }
        .Tbody { padding: 5px; }
        .separation{ border-right: solid 1px #cacaca; }
        .center{text-align: center}
        .tt{border-top: solid 1px #cacaca; }

        .sign{
           padding-top: 25px;
           padding-bottom: 25px;
           background-color: #F1F1F1;
        }
        .brdR{border-right: solid 10px white;}

        @page :body{ margin : -34px;}


        @media print{
                    .emplo{
                     width: 100%;
                        height: 1px;
                        border-right: 0;
                        border-top: 0;
                        border-bottom: 3px dashed #cacaca;
                        border-left: 0;
                        margin: 10px auto;
                        clear: both;
                    }

                    body{
                        background-image: url('/lab/resources/assets/imgs/croix5.png');
                        border-right : solid 8px #343434;
                        margin : -34;
                        font: Helvetica;
                        font-size: 0.6em;
                    }
        }

	</style>
</head>
<body>


<div class="row">

<?php $Now = $g->decompose($now) ?>

    {{--AFFICHAGES FORMULAIRE HORAIRES----------------------------------------------------------------------------}}
    <div class="HEADER">
        <table class="">
            <tbody >
                <tr class="">
                    <td class=""> <img src="{{asset('resources/assets/imgs/LOGOE.png')}}" alt=""/> </td>
                    <td class="">
                        <span class="headerSize lightGray">E</span> <span class="headerSize">urocomputer</span><span class="lightGray headerSize">.</span><br/>
                        <span> <b>- Service Comptabilité</b></span>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="bodyContent">
        <table>
            <tbody>
                <tr>
                    <td class="bodyTitle" >
                        <h2> <span class="red">D</span>emande d'absence</h2>
                    </td>
                </tr>
                <tr >
                    <td class="bodySub"> Par <u><b>{{$user->USER_nom}} {{$user->USER_prenom}}</b> le {{$Now['jour']}} {{$Now['num_j']}} {{$Now['mois']}} {{$Now['Y']}}</u></td>
                </tr>
            </tbody>
        </table>
    </div>

    <br/>


    <div class="tableABS">
        <table class="">
            <tbody class="">
                <tr>
                    <td colspan="2" class="Thead center separation"> <b>INFORMATION</b></td>
                    <td colspan="3" class="Thead center "><b>SOLDE</b></td>
                </tr>
                <tr>
                    <td class="Tbody">Nom</td>
                    <td class="Tbody separation">{{$user->USER_nom}}</td>
                    <td class="Tbody center">Congés Payés</td>
                    <td class="Tbody center">Récupération</td>
                    <td class="Tbody center">Heures NON payées</td>

                </tr>
                <tr>
                    <td class="Tbody">Prenom</td>
                    <td class="Tbody separation">{{$user->USER_prenom}}</td>
                    <td class="Tbody center">
                        @if(isset($solde))
                            {{$solde->CUMULE_cp_solde}} jours
                        @else - @endif</td>
                    <td class="Tbody center">
                        @if(isset($solde))
                            @if($solde->CUMULE_rec_solde == 0)
                             -
                            @else
                                {{$hg->mh($solde->CUMULE_rec_solde)}} h
                            @endif
                        @else - @endif
                    </td>
                    <td class="Tbody center">
                        @if(isset($solde))
                             @if($solde->CUMULE_hnp_solde == 0)
                              -
                             @else
                              {{$hg->mh($solde->CUMULE_hnp_solde)}} h
                             @endif

                        @else - @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tableABS">
        <table>

           <tr>
            <td  class="Thead separation center"> <b>DATE(S) DEMANDEE(S)</b></td>
            <td class="Thead center"> <b>NOMBRE D'HEURE(S)</b></td>
           </tr>
            @foreach( $dt as $k => $v)
           <tr>
               <?php $ddt = $g->decompose($v['d']->copy()) ;  ?>
               <td class="Tbody separation"> -    Le {{$ddt['jour']}} {{$ddt['num_j']}} {{$ddt['mois']}}  de {{$v['d']->copy()->format('G:i')}} à  {{$v['f']->copy()->format('G:i')}}</td>
               <td class="Tbody center"> {{$hg->mh($v['min'])}} h</td>
           </tr>

           @endforeach

           <tr >
            <td class="tt Tbody"> <b>TOTAL</b></td>
            <td class="tt Tbody center"> <b>{{$hg->mh($m)}} heures </b></td>
           </tr>
           <tr >
            <td class=" Tbody"> <b>PRESTATION</b></td>
            <td class=" Tbody center"> <b>  @if($presta == 'recup' )Récuperation @elseif($presta == 'cp')Congé payés @elseif($presta == 'np')Heures NON-payées @endif </b></td>
           </tr>
        </table>
    </div>

    <div class="tableABS">
        <table>
            <tr> <td colspan="2" class=" Thead"> <b>SIGNATURES</b></td> </tr>
            <tr> <td class="Tbody "> Employé</td>         <td class="Tbody "> Visa comptabilité</td></tr>
            <tr> <td class="Tbody  sign brdR"> </td> <td class="Tbody  sign brdR"></td></tr>
            <tr> <td class="Tbody "> Chef de service</td> <td class="Tbody "> Employeur</td></tr>
            <tr> <td class="Tbody  sign brdR"> </td> <td class="Tbody  sign brdR"></td></tr>

        </table>
    </div>
    <div class="emplo"> </div>
    <div class="tableABS">
        <table>
            <tr> <td class="" colspan="2"> Nom : {{$user->USER_nom}}      Prenom : {{$user->USER_prenom}}</td> </tr>
            <tr> <td class="Thead" colspan="2">Date(s) </td> </tr>
            @foreach( $dt as $k => $v)
            <tr>
                <?php $ddt = $g->decompose($v['d']->copy()) ;  ?>
                <td class="Tbody separation"> -    Le {{$ddt['jour']}} {{$ddt['num_j']}} {{$ddt['mois']}}  de {{$v['d']->copy()->format('G:i')}} à  {{$v['f']->copy()->format('G:i')}}</td>
                <td class="Tbody center"> {{$hg->mh($v['min'])}} h</td>
            </tr>

            @endforeach
            <tr>
                <td colspan="2" class="Tbody tt"> <b>SIGNATURE</b></td>
            </tr>
        </table>
    </div>

    {{------------------------------------------------------------------------------------------------------------}}
</div>

</body>
</html>