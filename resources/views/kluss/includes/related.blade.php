@if($kl->user_id == \Auth::user()->id)
    <div class="for--related">
        <div class="full-width">
            @if($accepted_applicant == null)
                @if($kl->user_id == \Auth::user()->id)
                    <div class="applicants">
                        <h3>Sollicitanten</h3>
                          @foreach($kluss_applicants as $s => $sol)
                              <div class="applicant {{$s != 0 ? 'first-app' : ''}}">
                                  <div class="applicant-image" style="background-image: url('/assets{{$sol->profile_pic}}')"></div>
                                  {{-- <img class="applicant-image" src="/assets{{$sol->profile_pic}}" alt="{{$sol->name}}'s profile picture"> --}}
                                  <a class="applicant-name" href="/profiel/{{$sol->id}}/{{str_slug($sol->name)}}">{{$sol->name}}</a>
                                  <div class="button-push">
                                      <form action="/chat/{{$sol->id}}" method="post">
                                          {!! csrf_field() !!}
                                          <input type="submit" name="chatstart" class="btn-contact" value="Contact">
                                      </form>
                                      {{-- Gebruiker accepteren --}}
                                      <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/accepteren" method="post">
                                          {!! csrf_field() !!}
                                          <input type="hidden" name="kluss_id" id="kluss_id" value="{{$kl->id}}">
                                          <input type="hidden" name="user_id" id="user_id" value="{{$sol->id}}">
                                          <input type="submit" name="" class="btn-accept" value="Accept">
                                      </form>
                                      {{-- Gebruiker weigeren --}}
                                      <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/weigeren" method="post">
                                          {!! csrf_field() !!}
                                          <input type="hidden" name="kluss_id" id="kluss_id" value="{{$kl->id}}">
                                          <input type="hidden" name="user_id" id="user_id" value="{{$sol->id}}">
                                          <input type="submit" name="" class="btn-deny" value="Weigeren">
                                          {{-- <a href="" role="button" class="btn btn-danger">Weigeren</a> --}}
                                      </form>
                                  </div>
                              </div>
                        @endforeach
                    {!! $kluss_applicants->appends(Request::except('sollicitanten'))->render() !!}
                    </div>
                @endif
            @endif
        </div>
        <div class="left-side">
            @if(didIPay($kl->id) == "")
                <p>Voor dat het klusje afgesloten kan worden moet er nog betaald worden.</p>
                <a href="/kluss/{{$kl->id}}/betalen">Kluss betalen</a>
            @else
                <p>Je hebt al voor dit klusje betaald. Deze kan je nu afsluiten.</p>
                <a href="/kluss/{{$kl->id}}/betalen" disabled>Reeds betaald</a>
            @endif
        </div>
        <div class="right-side">
            @if(didIPay($kl->id) == "")
                <p>Je kan de andere gebruiker een review geven nadat het klusje afgesloten werd.</p>
                <form action="/kluss/{{$kl->id}}/{{\Auth::user()->id}}/finished" method="post">
                    {!! csrf_field() !!}
                    <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen" disabled>
                </form>
            @elseif(didIPay($kl->id) != "" && didIMark(\Auth::user()->id, $kl->id) == "")
                <p>Je kan de andere gebruiker een review geven nadat het klusje afgesloten werd.</p>
                <form action="/kluss/{{$kl->id}}/{{\Auth::user()->id}}/finished" method="post">
                    {!! csrf_field() !!}
                    <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen">
                </form>
            @elseif(didIPay($kl->id) != "" && didIMark(\Auth::user()->id, $kl->id) != "")
                <p>Je hebt het klusje gemarkeerd als afgewerkt en je hebt er al voor betaald. Je kan de gebruiker nu een review geven.</p>
                <a href="/review/{{$kl->id}}" class="review-btn">Review schrijven</a>
            @endif
        </div>
    </div>
@elseif($kl->accepted_applicant_id == \Auth::user()->id)
    <div class="for--related">
        <div class="right-side full-width">
            @if(didIMark(\Auth::user()->id, $kl->id) == "")
                <p>Voor dat het klusje afgesloten kan worden moet deze gemarkeerd worden als afgerond. Je kan dit doen door op de knop hieronder te klikken.</p>
                <form action="/kluss/{{$kl->id}}/{{\Auth::user()->id}}/finished" method="post">
                    {!! csrf_field() !!}
                    <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen">
                </form>
            @else
                <p>Je hebt dit klusje al gemarkeerd als afgerond. Je kan de gebruiker nu een review schrijven:</p>
                <a href="/review/{{$kl->id}}">Review Schrijven</a>
            @endif
        </div>
    </div>
@endif
