@extends('admin.layouts.app')

@section('title') @if(isset($admin)) Edit Admin @else Add Admin @endif @endsection


    @section('content')
        <!-- Basic with Icons -->
        <?php 
            if(isset($admin)) {
                $action = route('admins.edit', ['admin' => $admin->id]);
            } else {
                $action = route('admins.store');
            }
        ?>
        <div class="card mb-4">            
            <div class="card-body">

                @include('admin/layouts/alert')
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="fullname">Name</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bx-user"></i>
                                </span>
                                <input type="text" name="name" value="<?php if(isset($admin)) { echo $admin->name; } else { echo old('name'); }  ?>" class="form-control" id="fullname" placeholder="Full Name"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="email">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bx-envelope"></i>
                                </span>
                                <input type="email" name="email" value="<?php if(isset($admin)) { echo $admin->email; } else { echo old('email'); }  ?>" id="email" class="form-control" placeholder="Email"/>
                                <span class="input-group-text">@example.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="password">Password</label>
                        <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                <i class='bx bxs-lock-open'></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                        </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="confirmation_password">Password Confirmation</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class='bx bx-lock-open'></i>
                                </span>
                                <input type="password" name="password_confirmation" id="confirmation_password" class="form-control" placeholder="Password Confirmation"/>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="profile_image">Profile Image</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class='bx bxs-image'></i>
                                </span>
                                <input type="file" name="profile_image" id="profile_image" class="form-control"/>
                            </div>
                            @if(!empty($admin->profile_image))
                                <div style="width: 150px; margin-top: 15px;">
                                    <img class="img-fluid" src="{{ url('uploads/admins/'.$admin->profile_image) }}" alt="<?php if(isset($admin)) { echo $admin->name; } ?>" />
                                </div>
                            @endif
                        </div>
                              
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="profile_image">Status</label>

                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" <?php echo (isset($admin->status)?((isset($admin->status)&&($admin->status == 'Banned'))?'checked="checked"':''):'checked="checked"');?> id="Banned" value="Banned"/>
                                <label class="form-check-label" for="Banned">Banned</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" <?php echo (isset($admin->status)&&($admin->status == 'Active'))?'checked="checked"':'';?> id="Active" value="Active"/>
                                <label class="form-check-label" for="Active">Active</label>
                            </div>
                        </div>

                        
                        
                    </div>
                    
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">@if(isset($admin)) Update @else Submit @endif</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection