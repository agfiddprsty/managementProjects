@extends('layouts.app')

@section('content')
    <h1>Create Project</h1>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <label for="deadline">Deadline:</label>
        <input type="date" name="deadline" id="deadline">
        <button type="submit">Create</button>
    </form>
@endsection