@extends('admin.auth.layout.app')

  @section('title')Forgot Password @endsection
  
  
  @section('content')
              
    <h4 class="mb-2">Forgot Password? 🔒</h4>
    @include('admin.layouts.alert')
    <form id="formAuthentication" class="mb-3" action="{{ route('admin.password.email') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
      </div>
      <button class="btn btn-primary d-grid w-100" type="submit">Send Reset Link</button>
    </form>
    <div class="text-center">
      <a href="{{ route('admin.login') }}" class="d-flex align-items-center justify-content-center">
        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
        Back to login
      </a>
    </div>
  @endsection
            

    