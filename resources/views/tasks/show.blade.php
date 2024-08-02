@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
    <h1>Task Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $task->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p class="card-text"><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
            <p class="card-text"><strong>Due Date:</strong> {{ $task->due_date ? $task->due_date->format('d-m-Y') : 'N/A' }}</p>

            <h5 class="mt-4">Prerequisites</h5>
            <ul>
                @forelse ($task->prerequisites as $prerequisite)
                    <li>{{ $prerequisite->title }}</li>
                @empty
                    <li>No prerequisites</li>
                @endforelse
            </ul>

            <h5 class="mt-4">Dependents</h5>
            <ul>
                @forelse ($task->dependents as $dependent)
                    <li>{{ $dependent->title }}</li>
                @empty
                    <li>No dependents</li>
                @endforelse
            </ul>

            <h5 class="mt-4">Comments</h5>
            <ul class="list-unstyled">
                @forelse ($task->comments as $comment)
                    <li>
                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                        <br><small>{{ $comment->created_at->format('d-m-Y H:i') }}</small>
                    </li>
                @empty
                    <li>No comments yet.</li>
                @endforelse
            </ul>

            @auth
                <form action="{{ route('tasks.storeComment', $task) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Add a Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
            @endauth

            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning mt-3">Edit Task</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Delete Task</button>
            </form>
        </div>
    </div>
@endsection
