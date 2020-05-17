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
        $youtube_url = Movie::select('youtube_url')->first();
        $poster1 = Movie::select('image1')->first();
        $poster2 = Movie::select('image2')->first();
        $poster3 = Movie::select('image3')->first();
        $showtime = Showtime::join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                            ->get();


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
