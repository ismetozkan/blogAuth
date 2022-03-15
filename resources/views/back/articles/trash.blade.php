@extends('back.layouts.master')
@section('content')
@section('title','Deleted Articles')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">"<strong><i>{{$articles->count()}}</i></strong>" Articles
        <a href="{{ route('articles.index') }}" class="btn btn-primary btn-sm">All Articles</a>
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
                            <a href="{{ route('callback', $article->id) }}" title="Call Back" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{ route('hard.delete', $article->id) }}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

