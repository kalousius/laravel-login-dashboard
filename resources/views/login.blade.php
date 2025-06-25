@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Login Page</h3>
            <p>This page tells you more about us. You can also log in from here.</p>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Login</h4>

                    @if(session('login_status'))
                        <div class="alert alert-info">
                            {{ session('login_status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                    </form>

                    <!-- Register Trigger -->
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Don't have an account? Register here
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reg_name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="reg_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="reg_phone" class="form-label">Phone Number</label>
                            <input type="text" name="phone" id="reg_phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="reg_username" class="form-label">Username</label>
                            <input type="text" name="username" id="reg_username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="reg_password" class="form-label">Password</label>
                            <input type="password" name="password" id="reg_password" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Register</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
