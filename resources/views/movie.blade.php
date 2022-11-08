@extends('layouts.page')

    @section('content')

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img">
                            <img class="img-fluid" src="{{ url('uploads/movies/'.$movie->featured_image) }}" alt="{{ ucwords($movie->title) }}">
                            <img class="img-fluid" src="{{ url('uploads/movies/'.$movie->featured_image) }}" alt="{{ ucwords($movie->title) }}">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h4 class="section-title">Movie Detail</h4>
                        <h1 class="display-5 mb-4">{{ ucwords($movie->title) }}</h1>
                        <?php echo $movie->description; ?>
                        <div class="d-flex align-items-center mb-5">
                            <p><b>Release Date :</b> {{ Carbon::parse($movie->released_date)->format('d M, Y') }}</p>
                            
                        </div>
                        <p><b>Total Likes :</b> {{ $movie->like_count }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


    @endsection