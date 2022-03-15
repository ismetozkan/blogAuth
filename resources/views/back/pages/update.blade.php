@extends('back.layouts.master')
@section('title','Update Article')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
      <div class="card-body">
          <form method="post" action="{{ route('pages.update', $pages->id) }}" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="form-group">
                  <label>Page Name</label>
                  <input type="text" name="title" class="form-control" value="{{ $pages->title }}" required>
              </div>


              <div class="form-group">
                  <label>Page Image</label>
                  <input type="file" name="image" class="form-control">
              </div>

              <div class="form-group">
                  <label>Page Content</label>  <br>
                  <img src="{{ asset($pages->image) }}" class="rounded" width="200"/>

                  <textarea id="editor" name="content" class="form-control" rows="4">{{ $pages->content }}
                  </textarea>
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Update</button>
              </div>
          </form>
      </div>
</div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote'@0.8.18'/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote();
        });
    </script>
@endsection
