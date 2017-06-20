@extends('layouts.app')

@section('content')
    <div class="main-content-wrap error-page">
        <h1>Wachtwoord opnieuw instellen</h1>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="logreg--label control-label">E-Mail:</label>

                <div class="">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="logreg--label control-label">Wachtwoord</label>

                <div class="">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="logreg--label control-label">Wachtwoord herhalen</label>
                <div class="">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <input type="submit" name="" value="Wachtwoord instellen" class="reset--pass">
                </div>
            </div>
        </form>
    </div>
@endsection
