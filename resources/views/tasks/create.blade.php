@extends('layouts.app')

@section('content')
    <h1>Add Task to {{ $project->name }}</h1>
    <form action="{{ route('tasks.store', $project) }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <label for="status">Status:</label>
        <select name="status">
            <option value="pending">Pending</option>
            <option value="in-progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
        <button type="submit">Add Task</button>
    </form>
@endsection
