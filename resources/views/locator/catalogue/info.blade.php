{{--$article->idLocator--}}
{{--$article->achats--}}



@if( ! $article->idLocator->isEmpty())

    @if(  $article->idLocator->where('id_etat',0)->count() <> 0) <i class="fa fa-info-circle"></i> @endif
    @if(  $article->idLocator->where('id_etat',1)->count() <> 0) <i class="fa fa-square green"></i> @endif
    @if(  $article->idLocator->where('id_etat',11)->count() <> 0) <i class="fa fa-square yellow"></i> @endif
    @if(  $article->idLocator->where('id_etat',21)->count() <> 0) <i class="fa fa-square violet"></i> @endif
    @if(  $article->idLocator->where('id_etat',22)->count() <> 0) <i class="fa fa-square red"></i> @endif

@endif

@if( ! $article->achats->isEmpty())
    @if(  $article->achats->count() <> 0) <i class="fa fa-credit-card fa-rotate-90 red"></i> @endif
@endif

<i class="fa fa-credit-card fa-rotate-90"></i>