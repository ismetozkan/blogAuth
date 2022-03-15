
@extends('front.layouts.master')
@section('content')
@section('title',$article->title)
@section('back_image',$article->image)
<!-- Main Content-->
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-lg-8 col-xl-9">
                <article class="mb-4">
                    <div class="container px-4 px-lg-3">
                        <div class="row gx-4 gx-lg-5 justify-content-center">
                            <div class="col-md-9 col-lg-8 col-xl-12">

                                {{$article->content}}
                                <br class="text-"><br> <i>Read:</i> <i>{{$article->hit}}</i></br> </span>

                            </div>
                        </div>
                    </div>
                </article>

                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary text-uppercase" href="#">Older Posts →</a>
                </div>
            </div>
            @include('widgets.categoryWidget')
        </div>
    </div>
@endsection
