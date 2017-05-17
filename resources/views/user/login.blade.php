@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="logreg--logo"></div>
            <div class="panel logreg--form">
                <div class="logreg--body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/aanmelden') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!--<label for="email" class="col-md-4 control-label">E-Mail Adres</label>-->

                            <div class="col-md-10 col-md-offset-1 logreg--field">
                                <label for="email">E-mail:</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                <!--<img src="/img/User-64.png" id="input_img_user" alt="">-->

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!--<label for="password" class="col-md-4 control-label">Wachtwoord</label>-->

                            <div class="col-md-10 col-md-offset-1">
                                <label for="password">Wachtwoord:</label>
                                <input id="password" type="password" placeholder="Wachtwoord" class="form-control" name="password" required>
                                <!--<img src="/img/Password-64.png" id="input_img_password" alt="">-->
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <div class="col-md-11 col-md-offset-1">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Onthoud me
                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <button type="submit" class="btn btn--form col-md-12">
                                    Log in
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <a class="btn--link" href="{{ url('/password/reset') }}">
                                    Wachtwoord vergeten?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
