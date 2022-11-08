@extends('admin.layouts.app')

@section('title') Users @endsection


    @section('content')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            {{-- <div class="demo-inline-spacing card-header"> 
                <a href="{{ route('users.create') }}">    
                <button type="button" class="btn btn-outline-primary">Add User</button>
                </a>
            </div> --}}

            <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    <?php $z = 0; ?>

                    @foreach($users as $row)
                        <tr>
                            <td>{{((($users->currentPage()-1) * $users->perPage() )+1) + $z}}</td>
                            <td><strong>{{ ucwords($row->name) }}</strong></td>
                            <td>{{ $row->email }}</td>
                            <td>
                               <img src="@if(isset($row->profile_image)) {{ url('uploads/users/'.$row->profile_image) }} @else {{ url('administration/assets/img/avatars/user.png') }} @endif" alt="{{ ucwords($row->name) }}" class="rounded-circle" style="width:55px;"/>                                    
                            </td>                    
                            
                            <td>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a href="{{ route('users.show', ['user' => $row->id]) }}" class="btn btn-outline-info">
                                        <i class="bx bx-eye-alt me-1"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('users.delete', ['id' => $row->id]) }}" class="btn btn-outline-danger">
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