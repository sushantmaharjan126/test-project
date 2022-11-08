@extends('admin.layouts.app')

@section('title') @if(isset($movie)) Edit @else Add @endif Movie @endsection


    @section('content')
        <!-- Basic with Icons -->
        <?php 
            if(isset($movie)) {
                $action = route('movies.edit', ['movie' => $movie->id]);
            } else {
                $action = route('movies.store');
            }
        ?>
        <div class="card mb-4">            
            <div class="card-body">

                @include('admin/layouts/alert')
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="fullname">Title</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                
                                <input type="text" name="title" value="<?php if(isset($movie)) { echo $movie->title; } else { echo old('title'); }  ?>" class="form-control" id="fullname" placeholder="Movie Title"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="release_date">Release Date</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                
                                <input type="date" name="release_date" value="<?php if(isset($movie)) { echo $movie->release_date; } else { echo old('release_date'); }  ?>" id="release_date" class="form-control" placeholder="Release Date"/>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="description">Description</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                
                                <textarea name="description" id="description" class="form-control tinymce" rows="15" placeholder="Text Here...."><?php if(isset($movie)) { echo $movie->description; } else { echo old('description'); }  ?></textarea>
                                
                            </div>
                        </div>
                    </div>
                    

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="profile_image">Movie Poster</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class='bx bxs-image'></i>
                                </span>
                                <input type="file" name="featured_image" id="profile_image" class="form-control"/>
                            </div>
                            @if(!empty($movie->featured_image))
                                <div style="width: 150px; margin-top: 15px;">
                                    <img class="img-fluid" src="{{ url('uploads/movies/'.$movie->featured_image) }}" alt="<?php if(isset($movie)) { echo $movie->title; } ?>" />
                                </div>
                            @endif
                        </div>
                              
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="profile_image">Status</label>

                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" <?php echo (isset($movie->status)?((isset($movie->status)&&($movie->status == 'Banned'))?'checked="checked"':''):'checked="checked"');?> id="Banned" value="Banned"/>
                                <label class="form-check-label" for="Banned">Banned</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" <?php echo (isset($movie->status)&&($movie->status == 'Active'))?'checked="checked"':'';?> id="Active" value="Active"/>
                                <label class="form-check-label" for="Active">Active</label>
                            </div>
                        </div>

                        
                        
                    </div>
                    
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">@if(isset($movie)) Update @else Submit @endif</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('footer')

        @include('admin/layouts/tinymce')

    @endsection