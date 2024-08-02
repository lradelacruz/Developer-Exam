@extends('layouts.app')

@section('title', 'Assigned Tasks')

@section('content')
    <div class="container">
        <h1>Assigned Tasks</h1>

        @if ($tasks->count())
            <ul class="list-group">
                @foreach ($tasks as $task)
                    <li class="list-group-item">
                        <a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a>
                        <span class="badge badge-info">{{ ucfirst($task->status) }}</span>
                    </li>
                @endforeach
            </ul>
            {{ $tasks->links() }} 
        @else
            <p>No tasks assigned to you.</p>
        @endif
    </div>
@endsection
