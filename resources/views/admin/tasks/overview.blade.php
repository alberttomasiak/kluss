@extends('layouts.admin')
@section('content')
    <div class="users--overview">
        <h1>Actieve klusjes</h1>

        <h2>Overzicht actieve klusjes</h2>
        <div class="task-overview">
        @foreach($tasks as $task)
            <div class="task-div">
                <div>
                    <img src="/assets{{$task->kluss_image}}" alt="{{$task->title}}">
                </div>
                <div class="task-text">
                    <h6>{{$task->title}}</h6>
                    <p>{{$task->description}}</p>
                    <p>{{$task->address}}</p>
                </div>
                <div class="report__btns">
                    <a href="/admin/block/{{$task->id}}/bewerken">Bewerken</a>
                </div>
            </div>
        @endforeach
        </div>
        {{$tasks->links()}}
        <h2>Overzicht klusjes voor goedkeuring</h2>
        <div class="task-overview">
            @foreach($approval as $appr)
                <div class="task-div">
                    <div>
                        <img src="/assets{{$appr->kluss_image}}" alt="{{$appr->title}}">
                    </div>
                    <div class="task-text">
                        <h6>{{$appr->title}}</h6>
                        <p>{{$appr->description}}</p>
                        <p>{{$appr->address}}</p>
                    </div>
                    <div class="approval__btns">
                        <a href="/admin/task/{{$appr->id}}/approve">Goedkeuren</a>
                        <a href="/admin/task/{{$appr->id}}/deny">Afwijzen</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{$approval->links()}}
    </div>
@endsection
