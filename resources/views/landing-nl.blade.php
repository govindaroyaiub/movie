<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie_details->movie_title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-queries.css') }}">
    {!! $movie_details->google_pixel !!}
    {!! $movie_details->fb_pixel !!}
    <script
        src='https://platform-api.sharethis.com/js/sharethis.js#property=5ec944357cfa4a0012b475a1&product=inline-share-buttons&cms=website'
        async='async'></script>
</head>

<body>

<a class="trailer-video d-none" href="{{ $youtube_url }}?autoplay=1&mute=1"></a>

<header class="movie-header position-relative">

    <h1 class="mr-1">{{ $movie_details->movie_title }} - {{ $movie_details->movie_description_short_nl }}</h1>

    <ul class="dropdown-flags">
        <li data-lang="en"><img src="https://image.flaticon.com/icons/svg/2969/2969780.svg" alt=""></li>
        <li data-lang="nl"><img src="https://image.flaticon.com/icons/svg/321/321264.svg" alt=""></li>
    </ul>
</header>


<div class="mobile-nav">
    <nav role="mobile-menu">
        <div class="menu-toggle">
            <input class="mobile-checkbox" type="checkbox"/>
            <span></span>
            <span></span>
            <span></span>
            <ul class="menu">
                <button class="tablinks mobile-link" onclick="openItem(event, 'getTickets')" id="defaultOpen">Koop
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
            <button class="tablinks" onclick="openItem(event, 'getTickets')" id="defaultOpen">Koop Tickets</button>
            <button class="tablinks" onclick="openItem(event, 'videos')">Videos</button>
            <button class="tablinks" onclick="openItem(event, 'synopsis')">Synopsis</button>
            <div class="hashtag text-uppercase font-weight-bold">{{ $movie_details->hashtag }}</div>
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
            <div class="movie-thumb p-2">
                <button role="button">
                    <img
                        width="60"
                        src="{{ $movie_details->image1 }}"
                        alt="">
                </button>
                <p>{{ $movie_details->movie_description_short_nl }}</p>
            </div>

            <div class="land-content">
                <form class="landing-search">
                    <div class="form-group position-relative">
                        <input id="land-search-input" type="search" class="form-control q" autocomplete="off"
                               placeholder="ZOEK">
                        <button type="submit" id="land-search-btn">&times;</button>
                    </div>
                </form>


                <div class="land-search-result">
                    <p class="ls-help text-center">KIES UW STAD OF LOCATIE</p>

                    <div class="main-acc accordion" id="accordionExample"></div>

                    <div class="city-acc accordion d-none" id="accordionExample2"></div>

                    <h2 class="h6 my-3 text-center">MEER VERTONINGEN IN DEZE STEDEN</h2>

                    <ul class="landing-city-list"></ul>

                </div>

                <br>

                <p class="text-center">BEKIJK DE TRAILER
                </p>
                <iframe class="js-iframe"
                        src="{{ $youtube_url }}" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>


                <div class="city-acc accordion d-none" id="accordionExample2"></div>


            </div>

        </section>

        <section class="movie-details">
            <h3 class="underline text-center my-3">
                {{ $movie_details->movie_description_short_nl }}
            </h3>

            <p class="excerpt mt-3">
                {{ $movie_details->movie_description_long_nl }}
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
                    <span>Duration:</span> {{ $movie_details->duration }}
                </p>
            </div>
        </section>
    </div>
</div>

<div id="videos" class="tabcontent">
    <div class="iframe-container">
        <iframe width="560" height="315" src="{{ $youtube_url }}" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>

    </div>
</div>

<div id="synopsis" class="tabcontent">
    <div class="synopsis-details">

        <img src="{{ $movie_details->image1 }}" alt="">

        <div class="synopsis-grid mt-5">

            <div class="excerpt">
                <h3 class="underline mb-3"> {{ $movie_details->movie_description_short_nl }}</h3>
                {{ $movie_details->movie_description_long_nl }}
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
                    <span>Duration:</span> {{ $movie_details->duration }}
                </p>
            </div>
        </div>
    </div>

</div>


<footer class="movie-footer py-3">
    <div class="container">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li><a data-toggle="tab" href="#menu0">Cookies</a></li>
            <li><a data-toggle="tab" href="#menu1">Gebruiksvoorwaarden</a></li>
            <li><a data-toggle="tab" href="#menu2">Privacy Policy</a></li>
            <li><a data-toggle="tab" href="#menu3">Credits</a></li>
        </ul>

        <div id="my-tab-content" class="tab-content text-white py-3 text-center">
            <div id="menu0" class="tab-pane fade in">
                <p>{{ $movie_details->cookies_nl }}</p>
            </div>
            <div id="menu1" class="tab-pane fade">
                <p>{{ $movie_details->terms_of_use_nl }}</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <p>{{ $movie_details->privacy_policy_nl }}</p>
            </div>
            <div id="menu3" class="tab-pane fade">
                <p>{{ $movie_details->credits_nl }}</p>
            </div>
        </div>


        <div class="align-items-center d-flex justify-content-center social-share">
            <div class="sharethis-inline-share-buttons"></div>
        </div>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
<script src="{{ asset('js/movie.js') }}"></script>
<script>
    $(function () {
        $('.mobile-link').on('click', function (e) {
            $(".mobile-checkbox").click();
        });

        $('[data-toggle="tooltip"]').tooltip()


        // language picker
        const nl = document.querySelector('[data-lang="nl"]');
        const en = document.querySelector('[data-lang="en"]');

        if (location.pathname === '/') {
            en.classList.add('d-block');
            moment.locale('nl');
            en.addEventListener('click', function () {
                location.href = '/en';
            })
        } else {
            nl.classList.add('d-block');
            moment.locale('en');
            nl.addEventListener('click', function () {
                location.href = '/';
            })
        }

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
