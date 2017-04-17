<div class="row container_id_article">

    <div class="column medium-3 small-3 large-3  column_info_id ">

        <div class="row container_id">
            <div class="column  column_id">
                <h4 class="googleB">
                    @if($article->id_etat == 1)
                        <i class=" fa fa-square green"></i>
                    @elseif($article->id_etat == 11)
                        <i class="fa  fa-square yellow"></i>
                    @elseif($article->id_etat == 21)
                        <i class="fa  fa-square violet"></i>
                    @elseif($article->id_etat == 22)
                        <i class="fa  fa-square red"></i>
                    @elseif($article->id_etat ==0 )
                        <i class="fa  fa-question-circle"></i>
                    @endif
                    ID{!! $article->id_locator !!}
                </h4>
            </div>
        </div>

        <div class="row container_emplacement">
            <div class="column column_emplacement googleT">
                <b>{{  $article->locator }}</b>
            </div>
        </div>

        <div class="row container_info">
            <div class=" center column fts_150 column_info"><i class="fa fa-info-circle "></i></div>
            <div class=" center column fts_150 column_edit"><a href="{{action('locatorController@edit',[$article->id_locator])}}"><i class="fa fa-pencil link"></i></a></div>
            <div class=" center column fts_150 column_out"><a href="{{action('locatorController@outId',[$article->id_locator])}}"><i class="fa fa-truck "></i></a></div>
        </div>

    </div>

    <div class="column medium-9 small-9 large-9 column_info_article">

        <div class="row container_info_article ">
            <div class="column b">
                @if(isset($article->articleModel->art_model)){{ $article->articleModel->art_model }}  @else @endif -
                @if(isset($article->articleModel->art_type))  {{ $article->articleModel->art_type }}  @else @endif -
                @if(isset($article->articleModel->art_marque))  {{$article->articleModel->art_marque }} @else @endif
            </div>
        </div>
        @if(isset($article->articleModel->short_desc))
            <div class="row padl10">
                <div class="column ">  <small class="googleT b ">{{strtoupper($article->articleModel->short_desc) }}</small></div>
            </div>
        @endif


        <div class="row">
            <div class="column fts_080 googleR">
                @if(strlen( $article->description ) == 0)
                    Aucune description pour cet article - N'hesite pas a l'édité au
                    besoin.
                @else
                    {!! $article->description !!}
                @endif
            </div>
        </div>
        <div class="row">
            <div class="column  medium-10">
                <b>SN : {!! $article->num_serie !!}</b> -
                <small>{!! $article->in_presta !!} - {!! $article->in_fournisseur !!}</small>
            </div>
            <div class="column right medium-2 b "> <small> <u>{!! $article->pu_ht !!} e </u></small></div>
        </div>


    </div>

</div>