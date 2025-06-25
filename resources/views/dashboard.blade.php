@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Top Bar -->
        <div class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom">
            <h4 class="m-0">Dashboard</h4>
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
                        <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-6">
                <div class="bg-white border rounded p-4 text-center">
                    <h2 class="mb-3">Welcome to Your Dashboard!</h2>
                    <p class="lead">You are now logged in. Here you can manage your data, access tools, and more.</p>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-md-3">
                <div class="bg-white border rounded p-3">
                    <h5>Info Panel</h5>
                    <p>Quick stats, messages, or tips can go here.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
