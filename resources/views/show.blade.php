@extends('layouts.app')

@section('title')
    {{ $task->title }}
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="font-medium text-gray-700 underline decoration-pink-500">← Go back to the task list!</a>
    </div>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500">Created: {{ $task->created_at->diffForHumans() }} ・ Updated: {{ $task->updated_at->diffForHumans() }}</p>

    <p class="mb-4">
        @if ($task->completed)
           <span class="font-medium text-green-500">Task is completed</span>
        @else
           <span class="font-medium text-red-500">Task is not completed</span>
        @endif
    </p>


    <div class="flex gap-2">
        <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/20 hover:bg-slate-20 text-slate-700">Edit</a>

        <form method="post" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/20 hover:bg-slate-20 text-slate-700">Mark as {{ $task->completed ? 'not completed' : 'completed' }}</button>
        </form>

        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/20 hover:bg-slate-20 text-slate-700">Delete</button>
        </form>
    </div>

@endsection
