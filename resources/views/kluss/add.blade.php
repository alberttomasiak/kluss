<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Kluss toevoegen</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="container col-md-4 col-md-offset-4 center">
            <form class="row flex-row add-kluss" enctype="multipart/form-data" id="kluss--toevoegen" action="{{ URL('/kluss/add')}}" method="post">
                <h1>Voeg een kluss toe:</h1>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" class="form-control" value="" placeholder="Stofzuigen kot">
                </div>

                <div class="form-group">
                    <label for="title">Beschrijving</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Klein kot, 2 uurtjes werk max!"></textarea>
                </div>

                <div class="form-group">
                    <label for="kluss_image">Foto toevoegen</label>
                    <input type="file" name="file" id="kluss--input">
                </div>

                <div class="form-group">
                    <label for="title">Credits</label>
                    <input type="number" name="price" class="form-control" value="" placeholder="15">
                </div>

                <div class="form-group">
                    <input type="hidden" name="latitude" id="kluss--lat" value="11.1">
                    <input type="hidden" name="longitude" id="kluss-lng" value="11.1">
                </div>

                <input type="submit" name="submit" class="btn btn-success" id="klussAdd_submit" value="Voeg kluss toe">
            </form>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>