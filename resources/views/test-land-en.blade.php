<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie_details->movie_title }} | {{ $movie_details->movie_description_short }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-queries.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5ec944357cfa4a0012b475a1&product=inline-share-buttons"
        async="async"></script>
</head>

<body>

<a class="trailer-video d-none" href="https://youtube.com/embed/eVVHmw3uH2Q?autoplay=1&mute=1"></a>

<header class="movie-header">
    <a href="#">
        <h1 class="mr-1">{{ $movie_details->movie_title }}</h1>
        <i class="fa fa-external-link"></i>
    </a>
    <select class="btn btn-secondary" style="position:relative" id="language" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option value="/test-nl" {{ (request()->is('test-nl')) ? 'selected' : '' }}>Netherlands</option>
        <option value="/test-en" {{ (request()->is('test-en')) ? 'selected' : '' }}>English</option>
    </select>
</header>

<div class="mobile-nav">
    <nav role="mobile-menu">
        <div class="menu-toggle">
            <input class="mobile-checkbox" type="checkbox"/>
            <span></span>
            <span></span>
            <span></span>
            <ul class="menu">
                <button class="tablinks mobile-link" onclick="openItem(event, 'getTickets')" id="defaultOpen">Get
                    Tickets
                </button>
                <button class="tablinks mobile-link" onclick="openItem(event, 'videos')">Videos</button>
                <button class="tablinks mobile-link" onclick="openItem(event, 'synopsis')">Synopsis</button>
            </ul>
        </div>
    </nav>
</div>

<div class="desktop-nav">
    <div class="tab-wrapper">
        <div class="tab">
            <button class="tablinks" onclick="openItem(event, 'getTickets')" id="defaultOpen">Get Tickets</button>
            <button class="tablinks" onclick="openItem(event, 'videos')">Videos</button>
            <button class="tablinks" onclick="openItem(event, 'synopsis')">Synopsis</button>
            <div class="sharethis-inline-share-buttons"></div>
        </div>
    </div>
</div>


<div id="getTickets" class="tabcontent">
    <div class="grid">
        <section class="movie-poster">
            <img src="{{ $movie_details->image1 }}"
                 alt="">
        </section>

        <section class="movie-content">
            <div class="movie-thumb">
                <button role="button">
                    <img
                        src=""
                        alt="">
                </button>
            </div>

            <div class="land-content">

                <form class="landing-search">
                    <div class="form-group position-relative">
                        <input id="land-search-input" type="search" class="form-control q" autocomplete="off"
                               placeholder="Search">
                        <button type="submit" id="land-search-btn">&times;</button>
                    </div>
                </form>


                <div class="land-search-result">
                    <p class="ls-help text-center">ENTER YOUR LOCATION ABOVE OR SELECT YOUR THEATER BELOW</p>

                    <div class="main-acc accordion" id="accordionExample"></div>

                    <div class="city-acc accordion d-none" id="accordionExample2"></div>

                    <h2 class="h6 my-3 text-center">MORE SHOWTIMES FOUND IN THE CITIES BELOW</h2>

                    <ul class="landing-city-list"></ul>

                </div>

                <br>

                <p class="text-center">WATCH THE TRAILER BELOW
                </p>

                <iframe class="w-100" height="200" src="{{ $youtube_url }}" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>

                <div class="city-acc accordion d-none" id="accordionExample2"></div>
            </div>

        </section>
        <section class="movie-details">
            <img width="100" class="d-block mx-auto" src="{{ $movie_details->image1 }}"
                 alt="">

            <h3 class="underline text-center my-3">
                {{ $movie_details->movie_description_short }}
            </h3>

            <p class="excerpt mt-3">
                {{ $movie_details->movie_description_long }}
            </p>

            <div class="synopsis-meta">
                <p>
                    <span>Directed by:</span> {{ $movie_details->director }}
                </p>

                <p>
                    <span>Written by:</span> {{ $movie_details->writer }}
                </p>

                <p>
                    <span>Produced by:</span> {{ $movie_details->producer }}
                </p>

                <p>
                    <span>Cast:</span> {{ $movie_details->actors }}
                </p>

                <p>
                    <span>Rating:</span> {{ $rating }}
                </p>

                <p>
                    <span>Duration:</span> {{ $movie_details->duration }}
                </p>
            </div>
        </section>
    </div>
</div>

<div id="videos" class="tabcontent">
    <div class="iframe-containerr">
        <iframe id="yt-video" class="w-100" src="{{ $youtube_url }}" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
        </iframe>
    </div>
</div>

<div id="synopsis" class="tabcontent">
    <div class="synopsis-details">

        <img src="{{ $movie_details->image1 }}" alt="">

        <div class="synopsis-grid mt-5">

            <div class="excerpt">
                <h3 class="underline mb-3"> {{ $movie_details->movie_description_short }}</h3>
                {{ $movie_details->movie_description_long }}
            </div>

            <div class="synopsis-meta">
                <p>
                    <span>Directed by:</span> {{ $movie_details->director }}
                </p>

                <p>
                    <span>Written by:</span> {{ $movie_details->writer }}
                </p>

                <p>
                    <span>Produced by:</span> {{ $movie_details->producer }}
                </p>

                <p>
                    <span>Cast:</span> {{ $movie_details->actors }}
                </p>

                <p>
                    <span>Rating:</span> {{ $rating }}
                </p>

                <p>
                    <span>Duration:</span> {{ $movie_details->duration }}
                </p>
            </div>
        </div>
    </div>

</div>

{{--<h2 class="h6 my-3">@lang('home.more_cities')</h2>--}}


<footer class="movie-footer">
    <div class="container">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li><a data-toggle="tab" href="#menu0">Cookies</a></li>
            <li><a data-toggle="tab" href="#menu1">Term of use</a></li>
            <li><a data-toggle="tab" href="#menu2">Privacy policy</a></li>
            <li><a data-toggle="tab" href="#menu3">Credits</a></li>
        </ul>

        <div id="my-tab-content" class="tab-content text-white py-5">
            <div id="menu0" class="tab-pane fade in">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>
            <div id="menu1" class="tab-pane fade">
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam.</p>
            </div>
            <div id="menu3" class="tab-pane fade">
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                    explicabo.</p>
            </div>
        </div>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('js/movie.js') }}"></script>
<script>
    $(function () {
        $('.mobile-link').on('click', function (e) {
            $(".mobile-checkbox").click();
        });

        document.querySelector('#yt-video').setAttribute('height', window.innerHeight / 2);

        // footer tab


        setTimeout(function () {
            $('.trailer-video').trigger('click');
        }, 10);

        const videoUrl = $('.trailer-video').attr('href');


        $('.trailer-video').magnificPopup({
            type: 'iframe',
            iframe: {
                patterns: {
                    youtube: {
                        src: videoUrl
                    }
                }
            }
        });
    });
</script>

</body>

</html>
