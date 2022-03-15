
@extends('front.layouts.master')
@section('title',$category->name.' Category')
@section('content')
<!-- Main Content-->
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-lg-8 col-xl-9">
            @if(count($articles)>0)
@include('widgets.articleWidget')
            @else
                <div class="alert alert-danger">
                    <h2> There is no article in this category! </h2>
                </div>
            @endif
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary text-uppercase" href="#">Older Posts →</a>
                </div>
            </div>
@include('widgets.categoryWidget')
        </div>
    </div>
@endsection

