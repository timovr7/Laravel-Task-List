@extends('layouts.app')

@section('title')
    @isset($task)
        Edit task
    @else
        Add task
    @endisset
@endsection

@section('content')
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        @csrf

        @isset($task)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="title" class="block uppercase text-slate-700 mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"
                @class([
                    'shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none',
                    'shadow-sm appearance-none border-red-500 w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none' => $errors->has(
                        'title'),
                ])>
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block uppercase text-slate-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="5" @class([
                'shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none',
                'shadow-sm appearance-none border-red-500 w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none' => $errors->has(
                    'title'),
            ])>
>{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description" class="block uppercase text-slate-700 mb-2">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10" @class([
                'shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none',
                'shadow-sm appearance-none border-red-500 w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none' => $errors->has(
                    'title'),
            ])>
>{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit"
                class="rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/20 hover:bg-slate-20 text-slate-700">
                @isset($task)
                    Update task
                @else
                    Add task
                @endisset
            </button>
            <a href="{{ route('tasks.index')}}" class="rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/20 hover:bg-slate-20 text-slate-700">Cancel</a>
        </div>

    </form>
@endsection
