<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'/>
    <title>Map</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no'/>
    <link rel='stylesheet' href="{{ asset('css/app.css') }}"/>
    <link rel='stylesheet' href="{{ asset('css/movie.css') }}"/>
    <link rel='stylesheet' href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.css'/>
    <style>
        .listing-area {
            background: var(--color-secondary-dark);
            height: 100vh;
            color: #fff;
        }

        .listing-title {
            background-color: var(--color-primary-light);
            color: #fff;
        }

        .listings {
            height: 100vh;
            overflow: auto;
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

        .map-wrapper {
        }

        .map {
            position: absolute;
            width: 100%;
            height: 100vh;
            top: 0;
            right: 0;
            bottom: 0;
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
            font-size: 1.2rem;
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
    </style>
</head>

<body>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="listing-area">
            <h3 class="listing-title p-3">Showtimes</h3>
            <div id='listings' class='listings'></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="map-wrapper">
            <div id='map' class='map'></div>
        </div>
    </div>
</div>


<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.1/mapbox-gl.js'></script>
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

    var showtimes = [
        {
            "id": 62,
            "cinema_id": 54,
            "date": "2020-06-11",
            "time": "20:00",
            "name": "Chassé Cinema",
            "address": "Claudius Prinsenlaan 8",
            "zip": "4811 DK",
            "city": "Breda",
            "phone": "076-5303127",
            "url": "www.chasse.nl",
            "long": "4.782180",
            "lat": "51.587471"
        },
        {
            "id": 53,
            "cinema_id": 21,
            "date": "2020-06-11",
            "time": "20:00",
            "name": "Cinecenter",
            "address": "Lijnbaansgracht 236",
            "zip": "1017 PH",
            "city": "Amsterdam",
            "phone": "020-6236615",
            "url": "www.cinecenter.nl",
            "long": "4.881780",
            "lat": "52.365028"
        },
    ];

    var stores = {
        type: "FeatureCollection",
        features: [],
    }

    for (i = 0; i < showtimes.length; i++) {
        stores.features.push({
            type: "Features",
            "geometry": {
                "type": "Point",
                "coordinates": [showtimes[i].long, showtimes[i].lat],
            },
            "properties": {
                "id": showtimes[i].id,
                "name": showtimes[i].name,
                "address": showtimes[i].address,
                "city": showtimes[i].city,
                "zip": showtimes[i].zip,
                "long": showtimes[i].long,
                "lat": showtimes[i].lat,
            }
        });
    }
    ;

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

    function buildLocationList(data) {
        data.features.forEach(function (store, i) {
            var prop = store.properties;

            var listings = document.getElementById('listings');
            var listing = listings.appendChild(document.createElement('div'));

            listing.id = "listing-" + prop.id;
            listing.className = 'item';

            var link = listing.appendChild(document.createElement('a'));
            link.href = '#';
            link.className = 'title';
            link.id = "link-" + prop.id;
            link.innerHTML = prop.address;

            var details = listing.appendChild(document.createElement('div'));
            details.innerHTML = prop.city;
            if (prop.phone) {
                details.innerHTML += ' · ' + prop.phoneFormatted;
            }

            link.addEventListener('click', function (e) {
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
            });
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
            .setHTML('<h3>' + currentFeature.properties.city + '</h3>' +
                '<h4>' + currentFeature.properties.address + '</h4>')
            .addTo(map);
    }
</script>


</body>

</html>
