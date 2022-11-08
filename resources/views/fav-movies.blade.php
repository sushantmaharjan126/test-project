@extends('layouts.page')

    @section('content')
        

        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h4 class="section-title">My Favorite Movies</h4>
                    {{-- <h1 class="display-5 mb-4"></h1> --}}
                </div>
                <div class="row g-0 team-items">

                    @foreach($fav_movies as $row)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item position-relative">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ url('uploads/movies/'.$row->poster) }}" alt="{{ ucwords($row->movie_title) }}">
                                    <div class="team-social text-center">
                                    </div>
                                </div>
                                <div class="bg-light text-center p-4">
                                    <h3 class="mt-2">{{ ucwords($row->movie_title) }}</h3>
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

