@extends('layouts.admin')
@section('content')
    <div class="users--overview">
        <h1>Rapporteringen</h1>

        <h2>Overzicht rapporteringen</h2>
        @foreach($userReports as $userReport)
            <div class="user-div">
                <div>
                    <img src="/assets{{$userReport->profile_pic}}" alt="{{$userReport->email}}'s profielfoto'">
                    <p>{{$userReport->email}} werd gerapporteerd voor: "{{$userReport->name}}"</p>
                </div>
                <div class="report__btns">
                    <a href="/admin/report/{{$userReport->id}}/bewerken">Bewerken</a>
                </div>
            </div>
        @endforeach
        {{$userReports->links()}}
    </div>
@endsection
