@extends('layouts.page')

    @section('content')
        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h4 class="section-title">Login</h4>
                    {{-- <h1 class="display-5 mb-4">We</h1> --}}
                </div>
                <div class="row g-5">
                    
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        @include('admin/layouts/alert')
                        <form action="{{ url('user/login') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
                                </div>
                                <p><a href="{{ url('register') }}">Create Your Account</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
    @endsection