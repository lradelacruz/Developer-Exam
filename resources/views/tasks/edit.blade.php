@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $task->description) }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>To Do</option>
                    <option value="in-progress" {{ old('status', $task->status) == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date) }}">
            </div>
            
            <div class="form-group">
                <label for="prerequisites">Prerequisites (Enter task IDs separated by commas)</label>
                <textarea class="form-control" id="prerequisites" name="prerequisites" rows="3">{{ old('prerequisites', $task->prerequisites->pluck('id')->implode(',')) }}</textarea>
                <small class="form-text text-muted">Enter task IDs separated by commas. Example: 1,2,3</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
@endsection
