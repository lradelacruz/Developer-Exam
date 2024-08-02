@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($tasks->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tasks->links() }}
        @else
            <p>No tasks available.</p>
        @endif
    </div>
@endsection
