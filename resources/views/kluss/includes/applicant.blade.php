@if($accepted_applicant != "")
    <h2>Informatie over de uitvoerder</h2>
    <div class="owner--wrap">
        <div class="applicant--info">
            <img class="task--user-image" src="/assets{{$accepted_applicant->profile_pic}}" alt="{{$accepted_applicant->name}}'s profile pic'">
            <p>{{$accepted_applicant->name}}</p>
            <a href="/profiel/{{$accepted_applicant->id}}/{{$accepted_applicant->name}}">Profiel van {{$accepted_applicant->name}}</a>
            <div class="applicant--btn-tab">
                @if($kl->user_id == \Auth::user()->id)
                    <form action="/chat/{{$accepted_applicant->id}}" method="post">
                        {{csrf_field()}}
                        <input type="submit" name="chatstart" class="btn btn-info" value="Contact">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endif
