@extends('layouts.app')
@section('content')
    <div class="bodyimg">
        <div class="container page-wrap">
            <div class="">
                <div class="">
                    <div class="logreg--logo"></div>
                    <div class="panel logreg--form">
                        <div class="logreg--body">
                            <form class="form-horizontal form--reg" role="form" method="POST" action="{{ url('/registreren') }}">
                                {!! csrf_field() !!}
                                @if(session('verificationMail'))
                                    <p class="form--message">{{session('verificationMail')}}</p>
                                @endif
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <!--<label for="name" class="col-md-4 control-label">Name</label>-->

                                    <div class="col-md-10 col-md-offset-1 logreg--field">
                                        <label class="logreg--label" for="name">Naam</label>
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
                                        <label class="logreg--label" for="email">Email</label>
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
                                        <label class="logreg--label" for="password">Wachtwoord</label>
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
                                        <label class="logreg--label" for="=password_confirmation">Wachtwoord herhalen</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Wachtwoord herhalen" required>
                                        <!--<img src="/img/Password-64.png"  class="input_img" alt="">-->
                                    </div>
                                </div>
                                <div class="form-group terms-wrap">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="terms-div-box"></div>
                                        <input type="checkbox" class="terms-box" id="terms-box" name="terms" value="agreed"><label class="terms-checker" for="terms-box">Ik ga akkoord met de <a href="/terms">Algemene Voorwaarden</a></label>
                                        @if(session('terms'))
                                            <p>{{session('terms')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $('.terms-checker').on('click', function(){
                                        $('.terms-div-box').toggleClass('terms-checked');
                                    });
                                    $('.terms-div-box').click(function(){
                                        $('.terms-checker').click();
                                    });
                                </script>
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1">
                                        <button type="submit" class="btn btn--form col-md-12">
                                            REGISTREER
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
