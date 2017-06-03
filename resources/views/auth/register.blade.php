@extends('layouts.app')

@section('content')
<div class="container page-wrap">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="logreg--logo"></div>
            <div class="panel logreg--form">
                <div class="logreg-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registreren') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <!--<label for="name" class="col-md-4 control-label">Name</label>-->

                            <div class="col-md-10 col-md-offset-1 logreg--field">
                                <label for="name">Naam</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Naam" autofocus>
                                <!--<img src="/img/User-64.png" class="input_img" alt="">-->
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!--<label for="email" class="col-md-4 control-label">E-Mail Address</label>-->

                            <div class="col-md-10 col-md-offset-1">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                <!--<img src="/img/Message-50.png" class="input_img_email" alt="">-->
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!--<label for="password" class="col-md-4 control-label">Password</label>-->

                            <div class="col-md-10 col-md-offset-1">
                                <label for="password">Wachtwoord</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Wachtwoord" required>
                                <!--<img src="/img/Password-64.png"  class="input_img" alt="">-->
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <!--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>-->

                            <div class="col-md-10 col-md-offset-1">
                                <label for="=password_confirmation">Wachtwoord herhalen</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Wachtwoord herhalen" required>
                                <!--<img src="/img/Password-64.png"  class="input_img" alt="">-->
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <button type="submit" class="btn btn--form col-md-12">
                                    Registreer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
