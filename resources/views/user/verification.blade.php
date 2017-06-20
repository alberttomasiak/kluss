@extends('layouts.app')
@section('content')
    <div class="main-content-wrap error-page">
            <h1>Verificatie mail opnieuw versturen</h1>
            <form class="" action="/verificatie_hersturen" method="post">
                {!! csrf_field() !!}
                <p>Typ hieronder uw e-mail adres in zodat we een nieuwe verificatiemail kunnen versturen.</p>
                <div class="form-group">
                    <input type="text" name="verification_box" class="form-control" id="verification_box" placeholder="E-mail:" value="">
                </div>
                <button type="submit" style="border-radius: 20px;" class="btn btn--form" name="button">Versturen</button>
            </form>
            @if(session('successful'))
                <p>{{session('successful')}}</p>
            @endif
    </div>
@endsection
