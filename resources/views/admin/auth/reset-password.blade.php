@extends('admin.auth.layout.app')

  @section('title')Admin Login @endsection
  
  
  @section('content')
    <h4 class="mb-2">Reset Your Password 🚀</h4>
    @include('admin.layouts.alert')
    <form id="formAuthentication" class="mb-3" action="{{ url('admin/password/reset') }}" method="POST">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control"id="email" name="email" value="{{ $email }}" placeholder="Enter your Email" readonly autofocus />
      </div>
      
      <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
          <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
      </div>

      <div class="mb-3 form-password-toggle">
        <label class="form-label" for="confirm_password">Confirm Password</label>
        <div class="input-group input-group-merge">
          <input type="password" id="confirm_password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
      </div>

      <button class="btn btn-primary d-grid w-100" type="submit">Submit</button>
    </form>

    <div class="text-center">
      <a href="{{ route('admin.login') }}" class="d-flex align-items-center justify-content-center">
        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
        Back to login
      </a>
    </div>
  @endsection
            