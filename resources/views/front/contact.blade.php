
@extends('front.layouts.master')
@section('title','Contact')
@section('back_image','https://maggenta.com/media/product/1060/ulastirma-ve-iletisim-trafigi-dunya-temali-duvar-kagidi_1.jpg')
@section('content')
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                        @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                        @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                    <p>Contact Us</p>
                    <div class="my-5">
                        <form method="post" action="{{route('contactPost')}}">
                            @csrf
                            <div class="form-floating">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." required />
                                <label for="name">Name</label>

                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email..." required/>
                                <label for="email">Email address</label>


                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="subject" name="subject"  placeholder="Enter your subject..."  required/>
                                <label for="subject">Subject</label>

                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem" required ></textarea>
                                <label for="message">Message</label>

                            </div>
                            <br />

                            <button class="btn btn-primary" id="submitButton" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
