<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Movie;
use App\Showtime;
use App\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function upload(Request $request)
    {
        
        //validate the xls file
        $this->validate($request, array(
        'file'      => 'required'
        ));
    
        if($request->hasFile('file'))
        {
            $check_location_data = Location::first();
            $check_showtime_data = Showtime::first();
            $check_movie_details = Movie::first();

            $file = $request->file('file')->getClientOriginalName(); 
            $request->file->move(public_path('/'), $file);

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(TRUE);
            $spreadsheet = $reader->load($file);

            $worksheet1 = $spreadsheet->getSheet(0);
            $worksheet2 = $spreadsheet->getSheet(1);
            $worksheet3 = $spreadsheet->getSheet(2);

            $localtion_list = [];
            $showtime_list = [];
            $full_movie_details = [];

            if(($check_location_data == NULL) && ($check_movie_details == NULL) && ($check_showtime_data == NULL))
            {
                if($worksheet3)
                {
                    $highestRow = $worksheet3->getHighestDataRow(); 
                    $highestColumn = $worksheet3->getHighestDataColumn();
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); 
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $movie_title = $worksheet3->getCellByColumnAndRow(2, $row)->getValue();
                        $movie_description_short = $worksheet3->getCellByColumnAndRow(3, $row)->getValue();
                        $movie_description_long = $worksheet3->getCellByColumnAndRow(4, $row)->getValue();
                        $cinema_date_sheet = $worksheet3->getCellByColumnAndRow(5, $row)->getValue();
                        $director = $worksheet3->getCellByColumnAndRow(6, $row)->getValue();
                        $producer = $worksheet3->getCellByColumnAndRow(7, $row)->getValue();
                        $writer = $worksheet3->getCellByColumnAndRow(8, $row)->getValue();
                        $actors = $worksheet3->getCellByColumnAndRow(9, $row)->getValue();
                        $youtube_url = $worksheet3->getCellByColumnAndRow(10, $row)->getValue();
                        $image1 = $worksheet3->getCellByColumnAndRow(11, $row)->getValue();
                        $image2 = $worksheet3->getCellByColumnAndRow(12, $row)->getValue();
                        $image3 = $worksheet3->getCellByColumnAndRow(13, $row)->getValue();
                        $duration = $worksheet3->getCellByColumnAndRow(14, $row)->getValue();
                        $ratings = $worksheet3->getCellByColumnAndRow(15, $row)->getValue();
                        $get_base_url = $worksheet3->getCellByColumnAndRow(16, $row)->getValue();
                        $get_ticket_url = $worksheet3->getCellByColumnAndRow(17, $row)->getValue();
                        $cinema_date = date('Y-m-d',\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cinema_date_sheet));
                        
                        if($movie_title != NULL)
                        {
                            $movie_details = [
                                'movie_title' => $movie_title,
                                'movie_description_short' => $movie_description_short,
                                'movie_description_long' => $movie_description_long,
                                'cinema_date' => $cinema_date,
                                'director' => $director,
                                'producer' => $producer,
                                'writer' => $writer,
                                'actors' => $actors,
                                'youtube_url' => $youtube_url,
                                'image1' => $image1,
                                'image2' => $image2,
                                'image3' => $image3,
                                'duration' => $duration,
                                'ratings' => $ratings,
                                'base_url' => $get_base_url,
                                'ticket_url' => $get_ticket_url
                            ];
                            array_push($full_movie_details, $movie_details);
                        }
                    }
                    Movie::insert($full_movie_details);
                }

                if($worksheet2)
                {   
                    $app_url = config('app.url');
                    $movie_details = Movie::where('base_url', '=', $app_url)->first();

                    $highestRow = $worksheet2->getHighestDataRow(); 
                    $highestColumn = $worksheet2->getHighestDataColumn(); 
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $cinema_id = $worksheet2->getCellByColumnAndRow(2, $row)->getValue();
                        $date_sheet = $worksheet2->getCellByColumnAndRow(3, $row)->getValue();
                        $time_sheet = $worksheet2->getCellByColumnAndRow(4, $row)->getValue();
                        $movie_id = $movie_details['id'];
                        $date = date('Y-m-d',\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($date_sheet));
                        $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($time_sheet)->format('H:i');
                        
                        if($cinema_id != NULL)
                        {
                            $showtime = [
                                'cinema_id' => $cinema_id,
                                'date' => $date,
                                'time' => $time,
                                'movie_id' => $movie_id
                            ];
                            array_push($showtime_list, $showtime);
                        }
                    }
                }

                if($worksheet1)
                {
                    $highestRow = $worksheet1->getHighestDataRow(); 
                    $highestColumn = $worksheet1->getHighestDataColumn(); 
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $name = $worksheet1->getCellByColumnAndRow(2, $row)->getValue();
                        $address = $worksheet1->getCellByColumnAndRow(3, $row)->getValue();
                        $zip = $worksheet1->getCellByColumnAndRow(4, $row)->getValue();
                        $city = $worksheet1->getCellByColumnAndRow(5, $row)->getValue();
                        $phone = $worksheet1->getCellByColumnAndRow(6, $row)->getValue();
                        $url = $worksheet1->getCellByColumnAndRow(7, $row)->getValue();
        
                        $location = [
                            'name' => $name,
                            'address' => $address,
                            'zip' => $zip,
                            'city' => $city,
                            'phone' => $phone,
                            'url' => $url
                        ];
                        array_push($localtion_list, $location);
                    }
                }
                
                Location::insert($localtion_list);
                Showtime::insert($showtime_list);
                return back()->with('success', 'File Uploaded!');
            }
            else
            {
                if($worksheet3)
                {
                    $highestRow = $worksheet3->getHighestDataRow(); 
                    $highestColumn = $worksheet3->getHighestDataColumn();
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); 
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $movie_title = $worksheet3->getCellByColumnAndRow(2, $row)->getValue();
                        $movie_description_short = $worksheet3->getCellByColumnAndRow(3, $row)->getValue();
                        $movie_description_long = $worksheet3->getCellByColumnAndRow(4, $row)->getValue();
                        $cinema_date_sheet = $worksheet3->getCellByColumnAndRow(5, $row)->getValue();
                        $director = $worksheet3->getCellByColumnAndRow(6, $row)->getValue();
                        $producer = $worksheet3->getCellByColumnAndRow(7, $row)->getValue();
                        $writer = $worksheet3->getCellByColumnAndRow(8, $row)->getValue();
                        $actors = $worksheet3->getCellByColumnAndRow(9, $row)->getValue();
                        $youtube_url = $worksheet3->getCellByColumnAndRow(10, $row)->getValue();
                        $image1 = $worksheet3->getCellByColumnAndRow(11, $row)->getValue();
                        $image2 = $worksheet3->getCellByColumnAndRow(12, $row)->getValue();
                        $image3 = $worksheet3->getCellByColumnAndRow(13, $row)->getValue();
                        $duration = $worksheet3->getCellByColumnAndRow(14, $row)->getValue();
                        $ratings = $worksheet3->getCellByColumnAndRow(15, $row)->getValue();
                        $get_base_url = $worksheet3->getCellByColumnAndRow(16, $row)->getValue();
                        $get_ticket_url = $worksheet3->getCellByColumnAndRow(17, $row)->getValue();
                        $cinema_date = date('Y-m-d',\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($cinema_date_sheet));
                        
                        if($movie_title != NULL)
                        {
                            $movie_details = [
                                'movie_title' => $movie_title,
                                'movie_description_short' => $movie_description_short,
                                'movie_description_long' => $movie_description_long,
                                'cinema_date' => $cinema_date,
                                'director' => $director,
                                'producer' => $producer,
                                'writer' => $writer,
                                'actors' => $actors,
                                'youtube_url' => $youtube_url,
                                'image1' => $image1,
                                'image2' => $image2,
                                'image3' => $image3,
                                'duration' => $duration,
                                'ratings' => $ratings,
                                'base_url' => $get_base_url,
                                'ticket_url' => $get_ticket_url
                            ];
                            array_push($full_movie_details, $movie_details);
                        }
                    }
                    Movie::insert($full_movie_details);
                }

                if($worksheet2)
                {
                    $app_url = config('app.url');
                    $movie_details = Movie::where('base_url', '=', $app_url)->first();

                    $highestRow = $worksheet2->getHighestDataRow(); 
                    $highestColumn = $worksheet2->getHighestDataColumn(); 
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $cinema_id = $worksheet2->getCellByColumnAndRow(2, $row)->getValue();
                        $date_sheet = $worksheet2->getCellByColumnAndRow(3, $row)->getValue();
                        $time_sheet = $worksheet2->getCellByColumnAndRow(4, $row)->getValue();
                        $movie_id = $movie_details['id'];
                        $date = date('Y-m-d',\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($date_sheet));
                        $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($time_sheet)->format('H:i');
                        
                        if($cinema_id != NULL)
                        {
                            $showtime = [
                                'cinema_id' => $cinema_id,
                                'date' => $date,
                                'time' => $time,
                                'movie_id' => $movie_id
                            ];
                            array_push($showtime_list, $showtime);
                        }
                    }
                }
                
                Showtime::insert($showtime_list);
                return back()->with('success', 'File Uploaded!');
            }
        }
    }
}
