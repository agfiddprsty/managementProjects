@extends('layouts.app')

@section('content')
    <h1>Projects</h1>
    <form action="{{ route('projects.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search projects">
        <button type="submit">Search</button>
    </form>
    <a href="{{ route('projects.create') }}">Add New Project</a>
    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
