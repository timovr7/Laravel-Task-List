<h1>
    Task list:
</h1>

<div>
    @forelse ($tasks as $task)
        <li>{{ $task->title}}</li>
    @empty
        <p>There are no tasks!</p>
    @endforelse
</div>
