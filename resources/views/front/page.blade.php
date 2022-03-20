
@extends('front.layouts.master')
@section('title',$page->title)
@section('back_image',$page->image)
@section('content')
    <div class="col-md-10 col-lg-10 mx-auto">
        {{$page->content}}
    </div>
@endsection
