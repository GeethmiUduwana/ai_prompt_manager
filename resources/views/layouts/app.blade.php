<!DOCTYPE html>
<html>
<head>

    <title>AI Prompt Manager</title>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-primary: #11998e;
            --green-secondary: #38ef7d;
            --green-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: #f0faf5; }

        .navbar-custom { background: var(--green-gradient) !important; }
        .navbar-custom .navbar-brand { font-weight: 700; font-size: 1.15rem; }
        .navbar-custom .nav-btn { padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s; }
        .nav-btn-outline { background: rgba(255,255,255,0.15); color: white !important; border: 1px solid rgba(255,255,255,0.35); }
        .nav-btn-outline:hover { background: rgba(255,255,255,0.3); color: white !important; }
        .nav-btn-solid { background: white; color: var(--green-primary) !important; }
        .nav-btn-solid:hover { background: #f0fdf4; color: var(--green-primary) !important; }
        .nav-btn-logout { background: rgba(0,0,0,0.15); color: white !important; border: none; }
        .nav-btn-logout:hover { background: rgba(0,0,0,0.25); color: white !important; }
        .btn-green { background: var(--green-gradient); color: white; border: none; font-weight: 600; border-radius: 10px; transition: all 0.2s; }
        .btn-green:hover { color: white; transform: translateY(-1px); box-shadow: 0 4px 15px rgba(17,153,142,0.35); }
        .btn-green-outline { background: white; color: var(--green-primary); border: 2px solid var(--green-primary); font-weight: 600; border-radius: 10px; transition: all 0.2s; }
        .btn-green-outline:hover { background: var(--green-primary); color: white; }
        .badge-green { background: var(--green-gradient) !important; color: white; font-weight: 600; }
        .card { border-radius: 14px; border: 1px solid #e8f5e9; transition: all 0.2s; }
        .card:hover { box-shadow: 0 8px 25px rgba(17,153,142,0.1); }
        .form-control:focus, .form-select:focus { border-color: var(--green-primary); box-shadow: 0 0 0 0.2rem rgba(17,153,142,0.15); }
        .alert-success { background: #ecfdf5; border-color: #a7f3d0; color: #065f46; border-radius: 10px; }
        .alert-danger { background: #fef2f2; border-color: #fecaca; color: #991b1b; border-radius: 10px; }
        .page-title { font-weight: 800; color: #1f2937; }
        .page-title::after { content: ''; display: block; width: 60px; height: 4px; background: var(--green-gradient); border-radius: 2px; margin-top: 8px; }

        @media (max-width: 768px) {
            .navbar-custom .navbar-collapse .d-flex { flex-direction: column; width: 100%; padding: 10px 0; }
            .navbar-custom .navbar-collapse .d-flex .nav-btn { width: 100%; text-align: center; }
            .navbar-custom .navbar-collapse .d-flex form { width: 100%; }
            .navbar-custom .navbar-collapse .d-flex form button.nav-btn { width: 100%; }
            .container { padding-left: 16px; padding-right: 16px; }
            .page-title { font-size: 1.5rem; }
            .card-body { padding: 1rem !important; }
        }
    </style>

</head>


<body>


<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">

    <div class="container">


        <a class="navbar-brand" href="/dashboard">

            AI Prompt Manager

        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

            @auth

            <div class="d-flex align-items-center gap-2">


                <a href="/prompts" class="nav-btn nav-btn-outline">

                    Prompts

                </a>



                <a href="/categories" class="nav-btn nav-btn-outline">

                    Categories

                </a>



                <a href="/favorites" class="nav-btn nav-btn-outline">

                    Favorites

                </a>



                <form action="/logout" method="POST" class="d-inline">

                    @csrf


                    <button type="submit" class="nav-btn nav-btn-logout">

                        Logout

                    </button>


                </form>


            </div>

            @endauth



            @guest

            <div class="d-flex align-items-center gap-2">


                <a href="/login" class="nav-btn nav-btn-solid">

                    Login

                </a>


                <a href="/register" class="nav-btn nav-btn-solid">

                    Register

                </a>


            </div>

            @endguest



        </div>

    </div>

</nav>




<div class="container mt-4 mb-5">


    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    @endif



    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    @yield('content')


</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
