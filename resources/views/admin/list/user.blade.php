@extends('admin.layouts.app')

@section('title') {{ ucwords($user->name) }} @endsection


    @section('content')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="demo-inline-spacing card-header"> 
                <h3>{{ ucwords($user->name) }}</h3>
            </div>

            <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>S.N</th>
                    <th>Favorite Movie Title</th>
                    <th>Release Date</th>
                    <th>Poster</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    <?php $z = 0; ?>

                    @foreach($fav_movies as $row)
                        <tr>
                            <td>{{((($fav_movies->currentPage()-1) * $fav_movies->perPage() )+1) + $z}}</td>
                            <td><strong>{{ ucwords($row->movie_title) }}</strong></td>
                            <td>{{ Carbon::parse($row->release_date )->format('d M, Y') }}</td>
                            <td>
                               <img src="@if(isset($row->poster)) {{ url('uploads/movies/'.$row->poster) }} @else {{ url('administration/assets/img/avatars/user.png') }} @endif" alt="{{ ucwords($row->movie_title) }}" class="rounded-circle" style="width:55px;"/>                                    
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