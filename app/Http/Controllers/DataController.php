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
        $app_url = config('app.url');
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');
        if($movie_details == NULL)
        {
            return view('coming_soon');
        }
        else
        {
            $youtube_url_db = Movie::select('youtube_url')->where('base_url', '=', $app_url)->first();
            $youtube_link = explode("/", $youtube_url_db['youtube_url']);
            $last_youtube_part = end($youtube_link);
            array_pop($youtube_link);
            $youtube_first = implode("/",$youtube_link);
            $youtube_url = 'https://youtube.com/embed/'. $last_youtube_part;

            $poster = Movie::select('image1', 'image2', 'image3')->where('base_url', '=', $app_url)->first();
            $showtime = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
                                ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                                ->where('movie_details.base_url', '=', $app_url)
                                ->where('movie_showtimes.date', '=', $current_date)
                                ->orderBy('show_location_static.name', 'ASC')
                                ->get();

            return view('welcome', compact(
                'movie_details',
                'youtube_url',
                'poster',
                'showtime'
            ));
        }
    }
}
