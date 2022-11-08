@extends('admin.auth.layout.app')

  @section('title')Admin Login @endsection
  
  
  @section('content')
    <h4 class="mb-2">Admin Login!👋 </h4>
    @include('admin.layouts.alert')
    <form id="formAuthentication" class="mb-3" action="{{ route('admin.login.submit') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
          
      </div>
      <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
          <label class="form-label" for="password">Password</label>
          <a href="{{ route('admin.password.request') }}">
            <small>Forgot Password?</small>
          </a>
        </div>
        <div class="input-group input-group-merge">
          <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
      </div>
      {{-- <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember-me" />
          <label class="form-check-label" for="remember-me"> Remember Me </label>
        </div>
      </div> --}}
      <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
      </div>
    </form>
  @endsection
          