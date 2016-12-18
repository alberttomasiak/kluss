@extends('layouts.app')
@section('content')
    <div class="kluss--add container col-md-4 col-md-offset-4 center">
            <form class="row flex-row add-kluss" enctype="multipart/form-data" id="kluss--toevoegen" action="{{ URL('/kluss/add')}}" method="post">
                <h1>Voeg een kluss toe:</h1>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group title-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" class="form-control kluss--title" value="" placeholder="Stofzuigen kot" required>
                </div>

                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea name="description" class="form-control kluss--description" rows="3" placeholder="Klein kot, 2 uurtjes werk max!"></textarea>
                </div>

                <div class="form-group">
                    <label for="kluss_image">Foto toevoegen</label>
                    <input type="file" class="kluss--image" name="file" id="kluss--input">
                </div>

                <div class="form-group price-group">
                    <label for="price">Credits</label>
                    <input type="number" name="price" class="kluss--price form-control" value="" placeholder="15" required>
                </div>

                <div class="form-group">
                    <input type="hidden" name="latitude" id="kluss--lat" value="">
                    <input type="hidden" name="longitude" id="kluss--lng" value="">
                </div>

                <input type="submit" name="submit" class="btn btn-success" id="klussAdd_submit" value="Voeg kluss toe">
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
@endsection