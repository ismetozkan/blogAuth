@extends('back.layouts.master')
@section('title','Update Category')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
      <div class="card-body">
          <form method="post" action="{{ route('category.update', $categories->id) }}" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" name="name" class="form-control" value="{{ $categories->name }}" required>
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
