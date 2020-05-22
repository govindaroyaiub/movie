<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie_details->movie_title }}</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mq.css') }}">
</head>

<body>

    <div id="land" class="landing-area">
        <header class="landing-header">
            {{ $movie_details->movie_title }} <a target="_blank" href="#"><i class="fa fa-external-link"></i></a>
        </header>

        <section class="container-fluid landing-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="land-poster mt-3">
                        <img class="img-fluid w-100" src="{{ $movie_details->image1 }}" alt="">
                    </div>

                    <div class="mobile-meta d-flex align-items-center d-sm-block d-md-none">
                        <img width="60" class="block mt-3 mx-3" src="{{ $movie_details->image1 }}" alt="">
                        <p class="m-0">{{ $movie_details->movie_description_short }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="land-content">
                        <form class="landing-search">
                            <div class="form-group">
                                <input id="land-search-input" type="search" class="form-control q" autocomplete="off"
                                    placeholder="Search">
                                <button type="submit" id="land-search-btn">&times;</button>
                            </div>
                        </form>


                        <div class="land-search-result">
                            <p class="ls-help">ENTER YOUR LOCATION ABOVE OR SELECT YOUR THEATER BELOW</p>

                            <div class="main-acc accordion" id="accordionExample"></div>

                            <div class="city-acc accordion d-none" id="accordionExample2"></div>

                        </div>

                        <br>

                        <p class="text-center">WATCH THE TRAILER BELOW
                        </p>

                        <iframe class="w-100" height="200" src="{{ $youtube_url }}" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>


                        <h2 class="h6 my-3">MORE SHOWTIMES FOUND IN THE CITIES BELOW</h2>

                        <ul class="landing-city-list"></ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="land-plot mt-3">
                        <img width="100" class="img-fluid mx-auto d-block m-2" src="{{ $movie_details->image1 }}"
                            alt="">

                        <h3 style="text-align:center; text-decoration: underline;">
                            {{ $movie_details->movie_description_short }}</h3>

                        <p class="my-1">{{ $movie_details->movie_description_long }}</p>

                        <div class="my-3">
                            <p><span class="text-red">DIRECTED BY:</span> {{ $movie_details->director }}</p>
                            <p><span class="text-red">WRITTEN BY:</span> {{ $movie_details->writer }}</p>
                            <p><span class="text-red">PRODUCED BY:</span> {{ $movie_details->producer }}</p>
                            <p><span class="text-red">CAST:</span> {{ $movie_details->actors }}</p>
                            <p><span class="text-red">Rating:</span> {{ $rating }}</p>
                            <p><span class="text-red">Duration:</span> {{ $movie_details->duration }}</p>
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


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>

</html>
