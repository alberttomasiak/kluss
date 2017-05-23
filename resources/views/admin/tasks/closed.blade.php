@extends('layouts.admin')
@section('content')
    <div class="users--overview">
        <h1>Gesloten klusjes</h1>

        <h2>Overzicht gesloten klusjes</h2>
        @foreach($tasks as $task)
            <div class="task-div">
                <div>
                    <img src="/assets{{$task->kluss_image}}" alt="{{$task->title}}">
                </div>
                <div>
                    <h6>{{$task->title}}</h6>
                    <p>{{$task->description}}</p>
                    <p>{{$task->address}}</p>
                </div>
                <div class="report__btns">
                    <a href="/admin/block/{{$task->id}}/bewerken">Bewerken</a>
                </div>
            </div>
        @endforeach
        {{$tasks->links()}}
    </div>
@endsection
