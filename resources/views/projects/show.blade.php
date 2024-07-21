@extends('layouts.app')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <p>Deadline: {{ $project->deadline }}</p>
    
    <h2>Progress</h2>
    <canvas id="progressChart"></canvas>

    <h2>Tasks</h2>
    <a href="{{ route('tasks.create', $project) }}">Add New Task</a>
    <ul>
        @foreach($project->tasks as $task)
            <li>
                {{ $task->title }} - {{ $task->status }}
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('progressChart').getContext('2d');
        var progressChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'In Progress', 'Completed'],
                datasets: [{
                    label: 'Task Status',
                    data: [
                        {{ $project->tasks->where('status', 'pending')->count() }},
                        {{ $project->tasks->where('status', 'in-progress')->count() }},
                        {{ $project->tasks->where('status', 'completed')->count() }}
                    ],
                    backgroundColor: ['#f1c40f', '#3498db', '#2ecc71']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endsection
