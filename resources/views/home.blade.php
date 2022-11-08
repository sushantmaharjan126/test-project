@extends('layouts.page')

    @section('content')
        <!-- Carousel Start -->
        <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="owl-carousel header-carousel position-relative">

                @foreach($movie_sliders as $row)
                    <div class="owl-carousel-item position-relative" data-dot="<img src='{{ url('uploads/movies/'.$row->featured_image) }}'>">
                        <img class="img-fluid" src="{{ url('uploads/movies/'.$row->featured_image) }}" alt="{{ ucwords($row->title) }}">
                        <div class="owl-carousel-inner">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-10 col-lg-8">
                                        <h1 class="display-1 text-white animated slideInDown">{{ ucwords($row->title) }}</h1>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Team Start -->
        <div class="container-xxl py-5" id="latest-movie">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h4 class="section-title">Latest Movies</h4>
                    {{-- <h1 class="display-5 mb-4"></h1> --}}
                </div>
                <div class="row g-0 team-items">
                    @include('admin/layouts/alert')
                    @foreach($movies as $row)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item position-relative">
                                <div class="position-relative">
                                    <a href="{{ url('movie/'.$row->slug) }}"><img class="img-fluid" src="{{ url('uploads/movies/'.$row->featured_image) }}" alt="{{ ucwords($row->title) }}"></a>
                                    <div class="team-social text-center">
                                        <a class="btn btn-square" href="@if(Auth::guard('web')->check()) {{ url('like-movie/'.$row->slug) }} @else {{ url('login') }} @endif"><i class="fa fa-thumbs-up"></i></a>
                                        <a class="btn btn-square" href="@if(Auth::guard('web')->check()) {{ url('favorite-movie/'.$row->slug) }} @else {{ url('login') }} @endif"><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="bg-light text-center p-4">
                                    <h3 class="mt-2"><a href="{{ url('movie/'.$row->slug) }}">{{ ucwords($row->title) }}</a></h3>
                                    <span class="text-primary">{{ Carbon::parse($row->released_date)->format('d M, Y') }}</span><br>
                                    <span class="text-primary">Total Likes : {{ $row->like_count }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Team End -->
    @endsection

