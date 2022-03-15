@extends('back.layouts.master')
@section('content')
@section('title','All Pages')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">"<strong><i>{{$pages->count()}}</i></strong>" Pages
        <a href="{{ route('trash.page') }}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i>Trash({{$deletedPages->count()}})</a>
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
                            <a target="_blank" href="{{ route('page',[$page->slug]) }}" title="Show" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('pages.edit', $page->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('delete.page', $page->id) }}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection

