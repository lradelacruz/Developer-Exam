@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Tasks Created</h5>
                    <p class="card-text">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tasks Assigned to Me</h5>
                    <p class="card-text">{{ $assignedTasks  }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tasks Completed</h5>
                    <p class="card-text">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
s