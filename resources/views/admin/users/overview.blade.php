@extends('layouts.admin')
@section('content')
<div class="users--overview">
    <h1>Gebruikers overzicht</h1>

    <h2>Admin gebruikers</h2>
    @foreach($adminUsers as $adminUser)
        <div class="user-div">
            <div>
                <img src="/assets{{$adminUser->profile_pic}}" class="user__img" alt="{{$adminUser->name}}'s profile pic'">
                <p>{{$adminUser->name}}</p>
            </div>
            <div class="user__btns">
                <a href="/admin/user/{{$adminUser->id}}/bewerken">Bewerken</a>
            </div>
        </div>
    @endforeach

    <h2>Gold gebruikers</h2>
    @foreach($goldUsers as $goldUser)
        <div class="user-div">
            <div>
                <img src="/assets{{$goldUser->profile_pic}}" class="user__img" alt="{{$goldUser->name}}'s profile pic'">
                <p>{{$goldUser->name}}</p>
            </div>
            <div class="user__btns">
                <a href="/admin/user/{{$goldUser->id}}/bewerken">Bewerken</a>
            </div>
        </div>
    @endforeach

    <h2>Starter gebruikers</h2>
    @foreach($regularUsers as $regularUser)
        <div class="user-div">
            <div>
                <img src="/assets{{$regularUser->profile_pic}}" class="user__img" alt="{{$regularUser->name}}'s profile pic'">
                <p>{{$regularUser->name}}</p>
            </div>
            <div class="user__btns">
                <a href="/admin/user/{{$regularUser->id}}/bewerken">Bewerken</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
