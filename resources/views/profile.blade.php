@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid">
    <!-- Top Bar -->
    <div class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom">
        <h4 class="m-0">My Profile</h4>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Main Layout -->
    <div class="row mt-3">
        <!-- Left Sidebar -->
        <div class="col-md-3">
            <div class="bg-white border rounded p-3">
                <h5>Navigation</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('profile') }}">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="col-md-9">
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
    </div>
</div>
@endsection
