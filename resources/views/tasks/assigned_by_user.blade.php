@extends('layouts.app')

@section('title', 'Tasks Assigned by Me')

@section('content')
    <h1>Tasks Assigned by Me</h1>

    @if ($tasks->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Assigned To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>@status($task->status)</td>
                        <td>{{ ucfirst($task->priority) }}</td>
                        <td>{{ $task->due_date ? $task->due_date->format('d-m-Y') : 'N/A' }}</td>
                        <td>{{ $task->assignedUser->name ?? 'Unassigned' }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tasks->links() }}
    @else
        <p>No tasks assigned by you.</p>
    @endif
@endsection
