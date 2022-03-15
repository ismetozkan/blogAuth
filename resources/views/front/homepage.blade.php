
@extends('front.layouts.master')
@section('title','HOME')
@section('content')
<!-- Main Content-->
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-lg-8 col-xl-9">
@include('widgets.articleWidget')
                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary text-uppercase" href="#">Older Posts →</a>
                </div>
            </div>
@include('widgets.categoryWidget')
        </div>
    </div>
@endsection

