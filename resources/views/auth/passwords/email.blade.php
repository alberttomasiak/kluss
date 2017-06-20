@extends('layouts.app')
<!-- Main Content -->
@section('content')
    <div class="main-content-wrap error-page">
        <h1>Wachtwoord vergeten?</h1>
        @if (session('status'))
            <p>{{session('status')}}</p>
        @endif
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <div>
                    <label for="email" class="logreg--label">E-Mail: </label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                    <input type="submit" value="Reset link versturen" class="reset--pass">
            </div>
        </form>
    </div>
@endsection
