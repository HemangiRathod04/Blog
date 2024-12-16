<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post-Comments</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- <!-- jQuery CDN --> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- <!-- Include flatpickr CSS --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- validation cdn --}}
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    {{-- <!-- Include SweetAlert2 CSS --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    {{-- <!-- Include SweetAlert2 JS --> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <!-- font for icon --> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    {{-- css style for sidebar --}}
    <link rel="stylesheet" href="{{ asset('layout.css') }}">

    <style>
        .text-danger {
            color: red;
        }
    </style>

</head>

<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="text-center text-light mb-4">
        <h3><i class="fas fa-pencil-alt"></i> Blog Post</h3>
        </div>
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @if (Auth::user()->role_id == 1)
            <a class="nav-link text-light" href="{{ route('admin.dashboard') }}"><i class="fas fa-users"></i> Users</a>
            <a class="nav-link text-light" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            @elseif(Auth::user()->role_id == 2)
            <a class="nav-link text-light" href="{{ route('user.dashboard') }}"><i class="fas fa-box"></i> Posts</a>
            <a class="nav-link text-light" href="{{ route('user.comment') }}"><i class="fas fa-box"></i> Comment</a>
            <a class="nav-link text-light" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>

            @endif
        </div>
    </div>
    {{-- Main content --}}
    <div class="content">
        @yield('content')
    </div>
    @stack('scripts')

    <!-- Bootstrap Bundle JS (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>