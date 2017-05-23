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

        <h2>Gearchiveerde rapporteringen</h2>
        @foreach($archivedReports as $archivedReport)
            <div class="user-div">
                <div>
                    <img src="/assets{{$archivedReport->profile_pic}}" alt="{{$archivedReport->email}}'s profielfoto'">
                    <p>{{$archivedReport->email}} werd gerapporteerd voor: "{{$archivedReport->name}}"</p>
                </div>
                <div class="report__btns">
                    <a href="/admin/report/{{$archivedReport->id}}/bewerken">Bewerken</a>
                </div>
            </div>
        @endforeach
        {{$archivedReports->links()}}
    </div>
@endsection
