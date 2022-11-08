@extends('admin.layouts.app')

@section('title') Admins @endsection


    @section('content')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="demo-inline-spacing card-header"> 
                <a href="{{ route('admins.create') }}">    
                <button type="button" class="btn btn-outline-primary">Add Admin</button>
                </a>
            </div>

            <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    <?php $z = 0; ?>

                    @foreach($admins as $row)
                        <tr>
                            <td>{{((($admins->currentPage()-1) * $admins->perPage() )+1) + $z}}</td>
                            <td><strong>{{ ucwords($row->name) }}</strong></td>
                            <td>{{ $row->email }}</td>
                            <td>
                               <img src="@if(isset($row->profile_image)) {{ url('uploads/admins/'.$row->profile_image) }} @else {{ url('administration/assets/img/avatars/user.png') }} @endif" alt="{{ ucwords($row->name) }}" class="rounded-circle" style="width:55px;"/>                                    
                            </td>                    
                            <td><span class="badge bg-label-<?php if($row->status == 'Active') { echo 'primary'; } else { echo 'danger'; } ?> me-1">{{ $row->status }}</span></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a href="{{ route('admins.edit', ['admin' => $row->id]) }}" class="btn btn-outline-info">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    @if($row->id != Auth::guard('admin')->user()->id)
                                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('admins.delete', ['id' => $row->id]) }}" class="btn btn-outline-danger">
                                            <i class="bx bx-trash me-1"></i>
                                        </a>
                                    @endif
                                </div>                             
                            </td>
                        </tr>
                    @endforeach
               
                </tbody>
            </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endsection