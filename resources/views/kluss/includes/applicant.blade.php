@if($accepted_applicant != "")
    <h2>Informatie over de uitvoerder</h2>
    <div class="owner--wrap">
        <div class="owner--wrap-left">
            <p class="owner--name">{{$accepted_applicant->name}}</p>
            <p class="owner--bio">{{$accepted_applicant->bio}}</p>
            <div class="star-ratings-sprite"><span style="width:calc({{getUserReviewRating($accepted_applicant->id)}} * 20%)" class="star-ratings-sprite-rating"></span></div>
        </div>
        <div class="contact--owner applicant--info">
            <div class="task--user-image" style="background-image: url('/assets{{$accepted_applicant->profile_pic}}')">

            </div>
            {{-- <img class="task--user-image" src="/assets{{$accepted_applicant->profile_pic}}" alt="{{$accepted_applicant->name}}'s profile pic'"> --}}
            <a href="/profiel/{{$accepted_applicant->id}}/{{$accepted_applicant->name}}">Profiel van gebruiker</a>
        </div>
    </div>
@endif
