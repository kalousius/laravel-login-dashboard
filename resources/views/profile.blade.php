@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>My Profile</h4>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit</a>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>Username:</strong> {{ $user->username }}</p>
        </div>
    </div>
</div>
@endsection
