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
                <form class="" action="/chat/{{$adminUser->id}}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" name="chatstart" class="btn btn--form" value="contact">
                </form>
            </div>
        </div>
    @endforeach
    {{$adminUsers->links()}}

    <h2>Gold gebruikers</h2>
    @foreach($goldUsers as $goldUser)
        <div class="user-div">
            <div>
                <img src="/assets{{$goldUser->profile_pic}}" class="user__img" alt="{{$goldUser->name}}'s profile pic'">
                <p>{{$goldUser->name}}</p>
            </div>
            <div class="user__btns">
                <form class="" action="/chat/{{$goldUser->id}}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" name="chatstart" class="btn btn--form" value="contact">
                </form>
                <a href="#notify-user-{{$goldUser->id}}" data-toggle="modal" role="button" class="btn btn--form">Notificatie</a>
                <a href="/admin/block/{{$goldUser->id}}/block" class="btn btn--form">BLOKKEER</a>
            </div>
        </div>
        @include('admin.users.modals.notify', ['id' => $goldUser->id])
    @endforeach
    {{$goldUsers->links()}}

    <h2>Starter gebruikers</h2>
    @foreach($regularUsers as $regularUser)
        <div class="user-div">
            <div>
                <img src="/assets{{$regularUser->profile_pic}}" class="user__img" alt="{{$regularUser->name}}'s profile pic'">
                <p>{{$regularUser->name}}</p>
            </div>
            <div class="user__btns">
                <form class="" action="/chat/{{$regularUser->id}}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" name="chatstart" class="btn btn--form" value="contact">
                </form>
                <a href="#notify-user-{{$regularUser->id}}" data-toggle="modal" role="button" class="btn btn--form">Notificatie</a>
                <a href="/admin/block/{{$regularUser->id}}/block" class="btn btn--form">BLOKKEER</a>
            </div>
        </div>
        @include('admin.users.modals.notify', ['id' => $regularUser->id])
    @endforeach
    {{$regularUsers->links()}}
</div>
@endsection
