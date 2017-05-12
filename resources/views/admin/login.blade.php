@extends('layouts.admin')
@section('content')
    <div class="login-wrapper">
    <a class="back-to-kluss" href="/home">Terug naar Kluss</a>
    <section class="login--form">
        <img src="/assets/img/logo-kluss.png" alt="Kluss logo">
        <form class="" action="{{ url('/admin/login') }}" method="post">
            {{ csrf_field() }}
            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-mail:</label>
                <input id="email" type="email" class="" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Wachtwoord:</label>
                <input id="password" type="password" placeholder="Wachtwoord" class="" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="admin--login-btn">Inloggen</button>
            <a class="btn--link" href="{{ url('/password/reset') }}">
                Wachtwoord vergeten?
            </a>
        </form>
        <div class="admin--login-footer">
            <p class="admin--login-info">info@kluss.be</p>
        </div>
    </section>
</div>
@endsection
