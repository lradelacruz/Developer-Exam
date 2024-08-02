@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
