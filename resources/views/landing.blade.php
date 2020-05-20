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

        <section class="landing-content">
            <div class="row">
                <div class="col-sm-4">
                    <div class="land-poster">
                        <img class="img-fluid w-100" src="{{ $movie_details->image1 }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4">
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

                            <div class="accordion r" id="accordionSearch"></div>
                        </div>

                        <br>

                        <p class="text-center">WATCH THE TRAILER BELOW
                        </p>

                        <iframe class="w-100" height="200" src="{{ $youtube_url }}" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>


                        <h2 class="h6 my-3">MORE SHOWTIMES FOUND IN THE CITIES BELOW</h2>


                        <ul class="landing-city-list">
                            @foreach($city as $row)
                                <li class="city-item"><a class="city-link" href="#"><i
                                            class="fa fa-search"></i>{{ $row->city }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="land-plot">
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
                            <p><span class="text-red">Rating:</span> {{ $movie_details->ratings }}</p>
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


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>

</html>
