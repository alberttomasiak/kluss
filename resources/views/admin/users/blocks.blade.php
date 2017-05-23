@extends('layouts.admin')
@section('content')
    <div class="users--overview">
        <h1>Geblokkeerde gebruikers</h1>

        <h2>Overzicht geblokkeerde gebruikers</h2>
        @foreach($userBlocks as $userBlock)
            <div class="user-div">
                <div>
                    <img src="/assets{{$userBlock->profile_pic}}" alt="{{$userBlock->email}}'s profielfoto'">
                    <p>{{$userBlock->email}} is geblokkeerd.</p>
                </div>
                <div class="report__btns">
                    <a href="/admin/block/{{$userBlock->id}}/bewerken">Bewerken</a>
                </div>
            </div>
        @endforeach
        {{$userBlocks->links()}}
    </div>
@endsection
