<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IPTV System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 2rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 1rem;
            font-weight: 600;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.5rem 1.5rem;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'IPTV System') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @if(session('xtream_username'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('live.tv') }}">{{ __('Live TV') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('movies') }}">{{ __('Movies') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('series') }}">{{ __('Series') }}</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link">{{ __('Logout') }}</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                $('#formDebug').show().text('Form gönderiliyor...');
                
                var formData = {
                    _token: $('input[name="_token"]').val(),
                    dns: $('#dns').val(),
                    username: $('#username').val(),
                    password: $('#password').val()
                };

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#formDebug').removeClass('alert-danger').addClass('alert-success').text('Başarılı! Yönlendiriliyor...');
                        window.location.href = '/dashboard';
                    },
                    error: function(xhr) {
                        var errorMessage = 'Bir hata oluştu: ';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage += xhr.responseJSON.message;
                        } else {
                            errorMessage += xhr.statusText;
                        }
                        $('#formDebug').removeClass('alert-info').addClass('alert-danger').text(errorMessage);
                        console.error('XHR Response:', xhr);
                    }
                });
            });
        });
    </script>
</body>
</html>