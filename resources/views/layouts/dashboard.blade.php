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
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                    @php
                        $loggedUser = \App\Models\User::where('username', session('username'))->first();
                    @endphp
                    @if($loggedUser && $loggedUser->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.list') }}">Users</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-6">
            @yield('main_content')
        </div>

        <!-- Right Sidebar -->
        
    </div>
</div>
@endsection
