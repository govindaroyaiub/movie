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
    <link rel='stylesheet' href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.css'/>
    <style>
        .map {
            position: absolute;
            width: 100%;
            height: 77vh;
            top: 0;
            right: 0;
            bottom: 0;
        }


        .accordion-title-wrapper {
            display: block;
        }

        .accordion-title-wrapper:hover {
            text-decoration: none;
        }

        .listings {
            overflow-y: auto;
            max-height: 70vh;
        }

        .listings .item {
            display: block;
            border-bottom: 1px solid #eee;
            padding: 10px;
            text-decoration: none;
        }

        .listings .item:last-child {
            border-bottom: none;
        }

        .listings .item .title {
            display: block;
            color: var(--color-primary-light);
            font-weight: 700;
        }

        .listings .item .title small {
            font-weight: 400;
        }

        .listings .item.active .title,
        .listings .item .title:hover {
            color: var(--color-primary-dark);
        }

        .listings .item.active {
            background: var(--color-secondary-light);
            color: #fff;
        }

        .movie-details {
            position: relative;
        }

        .marker {
            border: none;
            cursor: pointer;
            height: 56px;
            width: 56px;
            background-image: url('./marker.png');
            background-repeat: no-repeat;
            background-color: rgba(0, 0, 0, 0);
        }

        /* Marker tweaks */
        .mapboxgl-popup {
            padding-bottom: 50px;
        }

        .mapboxgl-popup-close-button {
            display: none;
        }

        .mapboxgl-popup-content {
            padding: 0;
            width: 180px;
        }

        .mapboxgl-popup-content-wrapper {
            padding: 1%;
        }

        .mapboxgl-popup-content h3 {
            background: var(--color-primary-dark);
            color: #fff;
            display: block;
            padding: 10px;
            border-radius: 3px 3px 0 0;
            margin: -15px 0 0 0;
            font-size: 1.2rem !important;
        }

        .mapboxgl-popup-content h4 {
            margin: 0;
            display: block;
            padding: 10px 10px 10px 10px;
            font-weight: 400;
            font-size: 1rem;
            background: var(--color-secondary-light);
            color: #fff;
        }

        .mapboxgl-popup-content div {
            padding: 10px;
        }

        .mapboxgl-container .leaflet-marker-icon {
            cursor: pointer;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-content {
            margin-top: 15px;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-tip {
            border-bottom-color: var(--color-primary-dark);
        }

        .mapboxgl-popup-anchor-bottom .mapboxgl-popup-tip {
            border-top-color: var(--color-secondary-light);
        }
    </style>
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
            <div id='map' class='map'></div>
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
                    <span>Rating:</span> {{ $rating }}
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
            // $('.trailer-video').trigger('click');
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
<script>
    // This will let you use the .remove() function later on
    if (!('remove' in Element.prototype)) {
        Element.prototype.remove = function () {
            if (this.parentNode) {
                this.parentNode.removeChild(this);
            }
        };
    }

    mapboxgl.accessToken = 'pk.eyJ1IjoiZWJuc2luYSIsImEiOiJjazhrNnp4bXgwYzB1M2ttN2FyYjdlNTN6In0.ywbV9mYdyq5dAKqPSqBpRg';

    /**
     * Add the map to the page
     */
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/dark-v10',
        center: [4.782180, 51.587471],
        zoom: 13,
        scrollZoom: false
    });

    let endpint;

    if (location.pathname === '/en') {
        const enUrl = `${location.href}api/shows`;
        endpint = enUrl.replace(/\/en/g, '/');
    } else {
        endpint = `${location.href}api/shows`;
    }


    var showtime = [];

    var stores = {
        type: "FeatureCollection",
        features: [],
    }

    fetch(endpint)
        .then(blob => blob.json())
        .then(data => showtime.push(...data))
        .then(() => {
            for (i = 0; i < showtime.length; i++) {
                stores.features.push({
                    type: "Features",
                    "geometry": {
                        "type": "Point",
                        "coordinates": [showtime[i].long, showtime[i].lat],
                    },
                    "properties": {
                        "id": showtime[i].id,
                        "name": showtime[i].name,
                        "address": showtime[i].address,
                        "city": showtime[i].city,
                        "zip": showtime[i].zip,
                        "long": showtime[i].long,
                        "lat": showtime[i].lat,
                    }
                });
            }
        });


    stores.features.forEach(function (store, i) {
        store.properties.id = i;
    });


    map.on('load', function (e) {
        map.addSource("places", {
            "type": "geojson",
            "data": stores
        });

        buildLocationList(stores);
        addMarkers();
    });


    function addMarkers() {
        stores.features.forEach(function (marker) {
            var el = document.createElement('div');
            el.id = "marker-" + marker.properties.id;
            el.className = 'marker';

            new mapboxgl.Marker(el, {offset: [0, -23]})
                .setLngLat(marker.geometry.coordinates)
                .addTo(map);

            el.addEventListener('click', function (e) {
                flyToStore(marker);
                createPopUp(marker);
                var activeItem = document.getElementsByClassName('active');
                e.stopPropagation();
                if (activeItem[0]) {
                    activeItem[0].classList.remove('active');
                }
                var listing = document.getElementById('listing-' + marker.properties.id);
                listing.classList.add('active');
            });
        });
    }

    function findMatches(wordToMatch, showtime) {
        return showtime.filter(show => {
            const regex = new RegExp(wordToMatch, "gi");
            return show.city.match(regex);
        });
    }

    function buildLocationList(data) {

        // PART 1
        var sf = document.querySelector('.landing-search');
        var r = document.querySelector('.main-acc');
        var cr = document.querySelector('.city-acc');
        var q = document.querySelector('#land-search-input');
        var b = document.querySelector('#land-search-btn');

        sf.addEventListener("submit", e => e.preventDefault());
        b.addEventListener("click", e => e.preventDefault());


        function searchBtnAnimationStart(e) {
            cr.classList.remove('d-block');
            cr.classList.add('d-none');
            gsap.to(b, {
                duration: 0.2,
                display: "block",
                width: "40px"
            });
        }

        function searchBtnAnimationEnd(e) {
            gsap.to(b, {
                duration: 0.001,
                display: "none",
                width: "0px"
            });
        }

        function removeSearchoutput() {
            r.classList.add("d-none");
            cr.classList.remove("d-block");
            cr.classList.add("d-none");
        }


        q.addEventListener("focus", searchBtnAnimationStart);
        b.addEventListener("click", searchBtnAnimationEnd);
        b.addEventListener("click", removeSearchoutput);


        function displayMatches() {
            r.classList.remove('d-none');
            const matchArr = findMatches(this.value, showtime);

            const html = matchArr
                .map(m => {
                    return `
                        <div>
                          <a id="link-${m.id}" class="accordion-title-wrapper title" href="#">
                            <div id="heading${m.id}">
                              <div data-toggle="collapse" data-target="#collapse${m.id}" aria-expanded="true" aria-controls="collapse${m.id}">
                                <div class="acc-title">
                                  <div class="d-flex">
                                    <i class="fa fa-file-video-o fa-3x text-red"></i>
                                    <h3 class="ml-3">${m.name}</h3>
                                  </div>
                                  <div style="margin-left: 60px" class="d-flex justify-content-between mt-2">
                                    <p class="m-0">${m.address}, ${m.city}</p>
                                    <p class="m-0 text-expand">${location.pathname === '/' ? moment(m.date).locale('nl').format("LL") : moment(m.date).locale('en').format("LL")} ${moment(m.time, "HH:mm").format("HH:mm")}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                          <div id="collapse${m.id}" class="collapse" aria-labelledby="heading${m.id}" data-parent="#accordionExample">
                            <div class="acc-description">
                              <h4>${m.movie_title}</h4>
                              <a class="text-uppercase" href="http://${m.url}" target="_blank"><i class="fa fa-ticket"></i> ${location.pathname === '/' ? 'Koop Tickets' : 'Get Tickets'}</a>
                            </div>
                          </div>
                        </div>
                    `;
                }).join("");

            r.innerHTML = html;

            var allTitles = document.querySelectorAll('.title');

            allTitles.forEach(title => {
                title.addEventListener('click', function (e) {
                    e.preventDefault();
                    for (var i = 0; i < data.features.length; i++) {
                        if (this.id === "link-" + data.features[i].properties.id) {
                            var clickedListing = data.features[i];
                            flyToStore(clickedListing);
                            createPopUp(clickedListing);
                        }
                    }
                    var activeItem = document.getElementsByClassName('active');
                    if (activeItem[0]) {
                        activeItem[0].classList.remove('active');
                    }
                    this.parentNode.classList.add('active');
                })
            })
        }


        q.addEventListener("change", displayMatches);
        q.addEventListener("keyup", displayMatches);

        // PART 02
        const cityAcc = document.querySelector(".city-acc");
        const cityUl = document.querySelector(".landing-city-list");

        const city = [...new Set(showtime.map(item => item.city))].sort();

        const cityHtml = city.map(c => {
                return `
                    <li class="city-item">
                      <a class="city-link" href="#"><iclass="fa fa-search"></i>${c}</a>
                    </li>
            `;
        }).join("");

        cityUl.innerHTML = cityHtml;

        const allCities = document.querySelectorAll(".city-link");
        allCities.forEach(singleCity => {
           singleCity.addEventListener('click', function(e) {
               e.preventDefault();
               cityAcc.classList.remove('d-none');

               const cityQuery = this.textContent;

               const filter = showtime.filter(el => {
                   return el.city === cityQuery;
               });

               const cHtml = filter.map(cm => {
                   return `
                        <div>
                          <a id="link-${cm.id}" class="accordion-title-wrapper title" href="#">
                            <div id="heading-${cm.id}">
                              <div data-toggle="collapse" data-target="#collapse-${cm.id}" aria-expanded="true" aria-controls="collapse-${cm.id}">
                                <div class="acc-title">
                                  <div class="d-flex">
                                    <i class="fa fa-file-video-o fa-3x text-red"></i>
                                    <h3 class="ml-3">${cm.name}</h3>
                                  </div>
                                  <div style="margin-left: 60px" class="d-flex justify-content-between mt-2">
                                    <p class="m-0">${cm.address}, ${cm.city}</p>
                                    <p class="m-0 text-expand">${location.pathname === '/' ? moment(cm.date).locale('nl').format("LL") : moment(cm.date).locale('en').format("LL")} ${moment(cm.time, "HH:mm").format("HH:mm")}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                          <div id="collapse-${cm.id}" class="collapse" aria-labelledby="heading-${cm.id}" data-parent="#accordionExample2">
                            <div class="acc-description">
                              <h4>${cm.movie_title}</h4>
                              <a class="text-uppercase" href="http://${cm.url}" target="_blank"><i class="fa fa-ticket"></i> ${location.pathname === '/' ? 'Koop Tickets' : 'Get Tickets'}</a>
                            </div>
                          </div>
                        </div>
                    `;
               })
                   .join("");
               cityAcc.innerHTML = cHtml;


               var allTitles = document.querySelectorAll('.title');

               allTitles.forEach(title => {
                   title.addEventListener('click', function (e) {
                       e.preventDefault();
                       for (var i = 0; i < data.features.length; i++) {
                           if (this.id === "link-" + data.features[i].properties.id) {
                               var clickedListing = data.features[i];
                               flyToStore(clickedListing);
                               createPopUp(clickedListing);
                           }
                       }
                       var activeItem = document.getElementsByClassName('active');
                       if (activeItem[0]) {
                           activeItem[0].classList.remove('active');
                       }
                       this.parentNode.classList.add('active');
                   })
               })

           })
        });
    }

    function flyToStore(currentFeature) {
        map.flyTo({
            center: currentFeature.geometry.coordinates,
            zoom: 15
        });
    }

    function createPopUp(currentFeature) {
        var popUps = document.getElementsByClassName('mapboxgl-popup');
        if (popUps[0]) popUps[0].remove();
        var popup = new mapboxgl.Popup({closeOnClick: false})
            .setLngLat(currentFeature.geometry.coordinates)
            .setHTML(`<h3 class="text-center">${currentFeature.properties.name}</h3><h4>${currentFeature.properties.address}, ${currentFeature.properties.zip}, ${currentFeature.properties.city}</h4>`)
            .addTo(map);
    }
</script>
</body>

</html>
