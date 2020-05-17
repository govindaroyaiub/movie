<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Showtime;
use App\Location;

class DataController extends Controller
{
    public function index()
    {
        $movie_details = Movie::get();
        if($movie_details->count() == 0)
        {
            return view('coming_soon');
        }
        else
        {
            $youtube_url_db = Movie::select('youtube_url')->first();
            $youtube_link = explode("/", $youtube_url_db['youtube_url']);
            $last_youtube_part = end($youtube_link);
            array_pop($youtube_link);
            $youtube_first = implode("/",$youtube_link);
            $youtube_url = 'https://youtube.com/embded/'. $last_youtube_part;
            dd($youtube_url);


            $poster1 = Movie::select('image1')->first();
            $poster2 = Movie::select('image2')->first();
            $poster3 = Movie::select('image3')->first();
            $showtime = Showtime::join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')->get();

            
            return view('welcome', compact(
                'movie_details',
                'youtube_url',
                'poster1',
                'poster2',
                'poster3',
                'showtime'
            ));
        }
    }
}
