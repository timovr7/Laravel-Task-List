<?php

use App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// INDEX REROUTE
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// FALLBACK REROUTE
Route::fallback(function () {
    return 'Still got somewhere';
});

// ------------------------------------------------------------- //
// INDEX
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

// CREATE
Route::view('/tasks/create', 'create')
->name('tasks.create');

// EDIT
Route::get('tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

// SHOW
Route::get('tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

// STORE
Route::post('/tasks', function(TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// UPDATE
Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

// DESTROY
Route::delete('tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully.');
})->name('tasks.destroy');

// TOGGLE-COMPLETE
Route::put('tasks/{task}/toggle-complete', function(Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');
