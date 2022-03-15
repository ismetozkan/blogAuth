@extends('back.layouts.master')
@section('title','Update Article')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
      <div class="card-body">
          <form method="post" action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="form-group">
                  <label>Article Title</label>
                  <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
              </div>

              <div class="form-group">
                  <label>Article Category</label>
                  <select type="text" name="category" class="form-control" required>
                      <option value="">Pick a Category</option>
                      @foreach($categories as $category)
                          <option value="{{ $category->id }}" @if($article->category_id == $category->id) {{ 'selected' }} @endif>{{ $category->name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <label>Article Image</label>
                  <input type="file" name="image" class="form-control">
              </div>

              <div class="form-group">
                  <label>Article Content</label>  <br>
                  <img src="{{ asset($article->image) }}" class="rounded" width="200"/>

                  <textarea id="editor" name="content" class="form-control" rows="4">
{{ $article->content }}
                  </textarea>
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Create</button>
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
