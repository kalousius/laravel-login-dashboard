<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">MySite</a>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
            <a class="nav-link" href="{{ url('/login') }}">Login</a>
            <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- Bootstrap JS (Optional for dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
