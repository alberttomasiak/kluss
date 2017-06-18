@extends('layouts.app')
@section('content')
    <div class="main-content-wrap">
        <h1>Instellingen</h1>
        <div class="tabs--settings">
            <ul class="tabs settings-nav" data-tabgroup="tab-group">
                <li><a href="#tab1" data-tabID="1" class=" active"><span>Persoonlijke informatie</span></a></li>
                <li><a href="#tab2" data-tabID="2" class""><span>Geblockte gebruikers</span></a></li>
            </ul>
            <section id="tab-group" class="settings-tabs tabgroup">
                <div id="tab1">
                    <form class="settings-form" id="settings-form" action="/settings/gegevens" enctype="multipart/form-data" files="true" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="userID" value="{{$userData->id}}">
                        <h3>Persoonlijke gegevens</h3>
                        <div class="logreg--field">
                            <label class="logreg--label" for="name">Naam</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{$userData->name}}">
                        </div>

                        <div class="logreg--field">
                            <label class="logreg--label" for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{$userData->email}}">
                        </div>

                        <div class="logreg--field">
                            <label class="logreg--label" for="bio">Over mezelf</label>
                            <textarea name="bio" class="form-control" id="bio" form="settings-form" rows="8" cols="30">{{$userData->bio}}</textarea>
                        </div>

                            <div class="image-upload">
                                <label for="file-input" class="logreg--label">
                                    <p>Klik op de afbeelding om een nieuwe te selecteren</p>
                                    {{-- <img src="/assets{{$userData->profile_pic}}" class="user--img" alt="{{$userData->name}}'s profile pic"> --}}
                                    <div class="user--img" style="background-image: url('/assets{{$userData->profile_pic}}');"></div>
                                    <input type="file" name="profile_pic" id="profile_pic" value="Kies bestand">
                                </label>
                            </div>

                        <h3>Accountgegevens</h3>

                        <div class="logreg--field">
                            <label class="logreg--label" for="password1">Nieuw wachtwoord</label>
                            <input type="password"class="form-control"  name="password1" id="password1" placeholder="Laat leeg voor hetzelfde wachtwoord" value="">
                        </div>
                        <div class="logreg--field">
                            <label class="logreg--label" for="password2">Herhaal wachtwoord</label>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Herhaal wachtwoord" value="">
                        </div>
                        <input type="submit" name="settings-send" value="Opslaan">
                    </form>
                </div>
                <div id="tab2">
                    <p class="first-text">
                        Wij bij KLUSS doen er alles aan om een aangename en efficiënte maar vooral betrouwbare omgeving voor buurtbewoners te creëren
                        om te klussen en te laten klussen. Helaas kan het soms voorvallen dat gebruikers zich ongepast of aanstootgevend gedragen of
                        afspraken niet nakomen. Dit willen we uiteraard ten allen tijde vermijden.
                    </p>
                    <p class="second-text">
                        Als je een gebruiker wilt vermijden, kan je kiezen om hem/haar te blokkeren. Een blokkering houdt in dat de geblokkeerde gebruiker je
                        geen berichten meer kan sturen, en hij/zij je klusjes niet te zien krijgt en ze bijgevolg niet kan aannemen.
                    </p>
                    @if(count($myBlocks) == 0)
                        <h5>Je hebt nog geen gebruikers geblokkeerd.</h5>
                    @else
                        @if(session('unblocked'))
                            <h5>{{session('unblocked')}}</h5>
                        @endif
                        @foreach($myBlocks as $block)
                            <div class="personal--block">
                                <div class="pic-name">
                                    <img src="/assets{{$block->profile_pic}}" alt="{{$block->name}}'s profile pic">
                                    <p>{{$block->name}}</p>
                                </div>
                                <a href="/gebruiker/{{$block->blocked_id}}/deblokkeren">Deblokkeer gebruiker</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
