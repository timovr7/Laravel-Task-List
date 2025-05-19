@extends('layouts.app')

@section('title')
    Task list:
@endsection

@section('content')

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{$task->title}}</a>
        </div>
    @empty
        <p>There are no tasks!</p>
    @endforelse

@endsection
