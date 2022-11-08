@extends('admin.layouts.app')

@section('title') Movies @endsection


    @section('content')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="demo-inline-spacing card-header"> 
                <a href="{{ route('movies.create') }}">    
                <button type="button" class="btn btn-outline-primary">Add Movie</button>
                </a>
            </div>

            <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Poster</th>
                    <th>NO. of Likes</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    <?php $z = 0; ?>

                    @foreach($movies as $row)
                        <tr>
                            <td>{{((($movies->currentPage()-1) * $movies->perPage() )+1) + $z}}</td>
                            <td><strong>{{ ucwords($row->title) }}</strong></td>
                            <td>{{ Carbon::parse($row->release_date )->format('d M, Y') }}</td>
                            <td>
                               <img src="@if(isset($row->featured_image)) {{ url('uploads/movies/'.$row->featured_image) }} @else {{ url('administration/assets/img/avatars/user.png') }} @endif" alt="{{ ucwords($row->title) }}" class="rounded-circle" style="width:55px;"/>                                    
                            </td> 
                            <td>{{ $row->like_count }}</td>                   
                            <td><span class="badge bg-label-<?php if($row->status == 'Active') { echo 'primary'; } else { echo 'danger'; } ?> me-1">{{ $row->status }}</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a href="{{ route('movies.edit', ['movie' => $row->id]) }}" class="btn btn-outline-info">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('movies.delete', ['id' => $row->id]) }}" class="btn btn-outline-danger">
                                        <i class="bx bx-trash me-1"></i>
                                    </a>
                                </div>                             
                            </td>
                        </tr>
                        <?php $z++; ?>
                    @endforeach
               
                </tbody>
            </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endsection