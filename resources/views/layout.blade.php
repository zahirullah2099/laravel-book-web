<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- bootstarp icon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid align-content-center">
                <a class="navbar-brand " href="#"><i class="bi bi-book-half text-primary mx-2 display-6"></i>Book
                    Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/books">Books</a>
                        </li>
                        @endauth


                        @guest
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('show.login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('show.register') }}">Register</a>
                            </li>
                        @endguest
                        
                        @auth
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('genre') }}">Genre</a>
                        </li>
                        {{-- <li> <a href="{{ route('logoutUser') }}" class="btn btn-danger btn-sm mx-auto">Logout &nbsp;</a></li>  --}}
                            <div class="d-flex align-items-center border mx-2">
                                <div class="nav-item dropdown">
                                    <a href="#"
                                        class="text-decoration-none mx-2 d-flex align-items-center dropdown-toggle"
                                        id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person display-6 text-primary me-2" style="font-size: 1.5rem;"></i>
                                        <!-- Icon size adjusted -->
                                        <span class="fs-5">{{ Auth::user()->name }}</i></span> <!-- User text -->
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">Update Profile</a></li>  
                                        <li> <a href="{{ route('logoutUser') }}" class="btn btn-danger btn-sm" style="margin-left: 40px">Logout &nbsp;</a></li> <!-- Logout link -->
                                    </ul>
                                </div>
                            </div>


                        @endauth


                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @yield('content');

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    
</body>
  


</html>
