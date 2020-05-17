<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
    <section class="welcome-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="poster">
                        <img class="img-fluid w-100" src="{{ $poster1->image1 }}" alt="">
                    </div>
                </div>
                <div class="col-md-4 text-center text-uppercase">
                    <div class="showtimes">
                        <h5 class="mb-3">Showtime coming here soon</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni fugiat aliquid soluta nemo a, eum hic quos! Quaerat iusto numquam soluta facilis architecto
                        </p>
                        <p>Repellendus neque quae iure sed sequi eos.</p>
                        <iframe class="w-100" height="200" src="{{ $youtube_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
</body>
</html>