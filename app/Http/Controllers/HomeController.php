<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\FavoriteMovie;
use Illuminate\Http\Request;
use App\Mail\MovieMail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function index()
    {
        $movie_sliders = Movie::where('status', 'Active')->orderBy('created_at', 'DESC')->select('title', 'featured_image')->limit(4)->get();


        $movies = Movie::where('status', 'Active')->orderBy('created_at', 'DESC')->get();

        return view('home', compact('movie_sliders', 'movies'));
    }

    public function favMovies()
    {
        $user_id = Auth::guard('web')->user()->id;

        $fav_movies = FavoriteMovie::join('movies', 'movies.id', '=', 'favorite_movies.movie_id')
                                        ->where('favorite_movies.user_id', $user_id)
                                        ->select('favorite_movies.*', 'movies.title as movie_title', 'movies.release_date as released_date', 'movies.featured_image as poster')
                                        ->get();

        return view('fav-movies', compact('fav_movies'));
    }

    public function movie($slug)
    {
        $movie = Movie::where('slug', $slug)->first();

        return view('movie', compact('movie'));
    }

    public function likeMovie($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        $movie->increment('like_count');
        return redirect()->back();
    }

    public function favoriteMovie($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        $user = Auth::guard('web')->user();

        $recored = FavoriteMovie::where('movie_id', $movie->id)->where('user_id', $user->id)->get();

        if($recored) {
            return back()->with('success', 'You already added movie to favourite.');
        } else {

            $fav_movie = new FavoriteMovie;

            $fav_movie->movie_id = $movie->id;
            $fav_movie->user_id = $user->id;

            $fav_movie->save();

            $fav_movie->movie_name = '$movie->title';
            $fav_movie->movie_released_date = $movie->released_date;
            $fav_movie->email = $user->email;

            

            \Mail::to($user->email)->send(new MovieMail($fav_movie));

            return back()->with('success', 'You have added movie to favourite.');
        }
    }
}
