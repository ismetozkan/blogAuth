@foreach($articles as $article)
    <!-- Post preview-->
    <div class="post-preview">
        <a href="{{route('single.blog',$article->slug)}}">
            <h2 class="post-title">
                {{($article->title)}}
            </h2>

            <img src="{{$article->image}}" width="700" height="250" alt="pic">

            <h3 class="post-subtitle">
                {{ substr($article->content, 0, 50) }} ...
            </h3>
        </a>
        <p class="post-meta">

            <a href="#">
                {{ $article->getCategory->name }}
            </a>
            <span class="float-lg-end"> {{$article->created_at->diffForHumans()}}</span>
        </p>
    </div>
    @if(!$loop->last)
        <hr>
    @endif

@endforeach
{{$articles->links()}}
