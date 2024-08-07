@if(count($articles) > 0)
    @foreach($articles as $article)
        <div class="post-preview">

            <img src="{{$article->image}}" width="1000" height="400">
            <a href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}">
                <h2 class="post-title">{{ $article->title }}</h2>
            </a>

            <h3 class="post-subtitle">
                {!!   Str::limit($article->content, 100, '...') !!}
            </h3>


            <p class="post-meta d-flex justify-content-between align-items-center">
                <span>Kategori: <a href="#">{{ $article->getCategory->name }}</a></span>
                <span class="text-right">{!! $article->created_at->diffForHumans() !!}</span>
            </p>
        </div>
        @if(!$loop->last)
            <hr>
        @endif
    @endforeach
@else
    <div class="alert alert-danger">
        <h1>Bu kategoriye ait yazı bulunamadı</h1>
    </div>
@endif
