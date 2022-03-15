@extends('back.layouts.master')
@section('content')
@section('title','Deleted Pages')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">"<strong><i>{{$pages->count()}}</i></strong>" Pages
        <a href="{{ route('pages.index') }}" class="btn btn-primary btn-sm">All Pages</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Picture</th>
                    <th>Page Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach($pages as $page)
                    <tr>
                        <td>
                            <img src="{{ asset($page->image) }}" width="60">
                        </td>
                        <td>{{ $page->title }}</td>
                        <td>
                            <a href="{{ route('callback.page', $page->id) }}" title="Call Back" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{ route('hard.delete.page', $page->id) }}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

