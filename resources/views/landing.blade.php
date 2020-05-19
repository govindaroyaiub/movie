<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mq.css') }}">
</head>

<body>


    <div id="land" class="landing-area">
        <header class="landing-header">
            {{ $movie_details->movie_title }} <a target="_blank" href="#"><i class="fa fa-external-link"></i></a>
        </header>

        <section class="landing-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="land-poster">
                        <img class="img-fluid w-100"
                            src="{{ $movie_details->image1 }}"
                            alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="land-content">
                        <form class="landing-search">
                            <div class="form-group">
                                <input id="land-search-input" type="search" class="form-control q" autocomplete="off" placeholder="Search">
                                <button type="submit" id="land-search-btn">&times;</button>
                            </div>
                        </form>


                        <div class="land-search-result">
                            <p class="ls-help">ENTER YOUR LOCATION ABOVE OR SELECT YOUR THEATER BELOW</p>

                            <div class="accordion r" id="searchAcc"></div>
                        </div>

                        <br>

                        <p class="text-center">WATCH THE TRAILER BELOW
                        </p>

                        <iframe class="w-100" height="200" src="{{ $youtube_url }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>


                        <h2 class="h6 my-3">MORE SHOWTIMES FOUND IN THE CITIES BELOW</h2>


                        <ul class="landing-city-list">
                        @foreach($city as $row)
                            <li class="city-item"><a class="city-link" href="#"><i class="fa fa-search"></i>{{$row->city}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="land-plot">
                    <img class="img-fluid m-2" src="{{ $movie_details->image1 }}" style="position:relative; left:20%;" alt="">

                            <h3>{{ $movie_details->movie_description_short }}</h3>

                        <p class="my-1">{{ $movie_details->movie_description_long }}</p>

                        <div class="my-3">
                            <p><span class="text-red">DIRECTED BY:</span> {{ $movie_details->director }}</p>
                            <p><span class="text-red">WRITTEN BY:</span> {{ $movie_details->writer }}</p>
                            <p><span class="text-red">PRODUCED BY:</span> {{ $movie_details->producer }}</p>
                            <p><span class="text-red">CAST:</span> {{ $movie_details->actors }}</p>
                            <p><span class="text-red">Rating</span> {{ $movie_details->ratings }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="landing-footer">
            <ul>
                <li><a href="#">Cookies</a></li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Credits</a></li>
            </ul>
        </footer>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
