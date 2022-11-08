<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $movies = Movie::orderBy('like_count', 'DESC')->paginate(10);

        return view('admin.list.movies', compact('movies'));
    }

    public function create()
    {
        return view('admin.form.movie');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'release_date' => 'required',
            'status' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $movie = new Movie;

        $movie->title = request('title');
        $movie->slug = Str::slug( request('title'), '-');
        $movie->release_date = request('release_date');
        $movie->description = request('description');
        $movie->status = request('status');

        $file = request()->file('featured_image');
        if($file != null) {

            $image_name = 'movie-'.time().".".$file->getClientOriginalExtension();

            $img = Image::make($file);

            $img->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            if(!File::exists('uploads/movies')) {
                File::makeDirectory('uploads/movies');
            }

            $img->save('uploads/movies/'.$image_name);
 
            $movie->featured_image = $image_name;        
        }

        $movie->save();

        return redirect('admin/movies')->with('success', 'New Movie has been Added.');
    }

    public function edit(Movie $movie)
    {
        return view('admin.form.movie', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);

        $request->validate([
            'title' => 'required',
            'release_date' => 'required',
            'status' => 'required',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = ([
            'title' => request('title'),
            'slug' => Str::slug( request('title'), '-'),
            'release_date' => request('release_date'),
            'description' => request('description'),
            'status' => request('status'),
        ]);

        $file = request()->file('featured_image');
        if($file != null) {

            @unlink('uploads/movies/'.$movie->featured_image);

            $image_name = 'movie-'.time().".".$file->getClientOriginalExtension();

            $img = Image::make($file);
            $img->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            

            $img->save('uploads/movies/'.$image_name);

            $data1 = (['featured_image' => $image_name]);
            Movie::where('id', $id)->update($data1);
        }

        Movie::where('id', $id)->update($data);

        return redirect()->back()->with('success','Movie Updated.');
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);
        if(isset($movie)) {
            $affected = Movie::whereId($id)->delete();
            if($affected > 0) {
                @unlink('uploads/movies/'.$movie->featured_image);
                return redirect('admin/movies')->with('success', 'Movie deleted.');
            } else {
                return redirect('admin/movies')->with('error', 'Movie deletion failed.');
            }
        } else {
            return redirect('admin/movies')->with('error', 'Movie not found.');
        }
    }
}
