@if(isset($articles))
    @if($articles <> [])
        @foreach($articles as $article)

            @if($article->out_datetime == null)
                @include('locator.article.exist')
            @else
                @include('locator.article.out')
            @endif

        @endforeach
    @endif
@endif