@extends('back.layouts.master')
@section('content')
@section('title','All Articles')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">"<strong><i>{{$articles->count()}}</i></strong>" Articles
        <a href="{{ route('trash') }}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i>Trash ({{ ($deletedArticles->count()) }})</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Picture</th>
                    <th>Article Title</th>
                    <th>Category</th>
                    <th>Hit</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <img src="{{ asset($article->image) }}" width="60">
                        </td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->getCategory->name }}</td>
                        <td>{{ $article->hit }}</td>
                        <td>{{ $article->created_at->diffForHumans() }}</td>
                        <td>
                            <label>
                                <input data-id="{{$article->id}}" data-status="{{ $article->status }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Passive" {{ $article->status ? 'checked' : '' }}>
                            </label>
                        </td>
                        <td>
                            <a target="_blank" href="{{ route('single.blog',[$article->slug]) }}" title="Show" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('articles.edit', $article->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('delete', $article->id) }}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

@section('footerScript')
    <script>
        $(document).ready(function (){
            $('[data-toggle="toggle"]').on('click', function(e) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('changeStatus') }}',
                    data: {
                        'status': $(this).find('[type="checkbox"]').prop('checked'),
                        'id': $(this).find('[type="checkbox"]').data('id')
                    },
                    success: function(data){
                        console.log(data.success())
                    }
                });
            });

            $.each($('[data-toggle="toggle"]').find('[type="checkbox"]'), function (key, item){
                var status = $(item).data('status') == 0 ? 'on' : 'off';
                $(item).bootstrapToggle(status);
            })
        });
    </script>
@endsection
