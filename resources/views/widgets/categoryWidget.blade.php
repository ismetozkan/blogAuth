@isset($categories)
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Categories
            <div class="list-group">
                @foreach($categories as $category)

                    <li class="list-group-item @if(\Illuminate\Support\Facades\Request::segment(2)==$category->slug) active @endif">
                        <a href="{{route('category.show',$category->slug)}}">{{$category->name}}</a>
                        <span class="badge bg-danger float-right">{{$category->articleNum()}}</span>
                    </li>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
