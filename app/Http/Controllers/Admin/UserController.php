<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.list.users', compact('users'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();

        $fav_movies = FavouriteMovie::join('movies', 'movies.id', '=', 'favorite_movies.movie_id')
                                        ->where('favorite_movies.user_id', $id)
                                        ->select('favorite_movies.*', 'movies.title as movie_title', 'movies.release_date as released_date', 'movies.featured_image as poster')
                                        ->get();

        return view('admin.list.user', compact('user', 'fav_movies'));
    }
}
