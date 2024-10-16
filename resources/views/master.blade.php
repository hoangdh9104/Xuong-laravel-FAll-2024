<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', 'Welcome')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <nav class="navbar d-flex justify-content-evenly" style="background-color: #e3f2fd;">
            <a class="nav-link active" href="/" aria-current="page">Welcome</a>
            <a class="nav-link" href="{{ route('customers.index') }}">Quan ly khach hang</a>
            <a class="nav-link" href="{{ route('employees.index') }}">Quan ly nhan vien</a>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
            <a class="nav-link" href="{{ route('admin.orders.index') }}">Nhan vien</a>
            <a class="nav-link" href="{{ route('client.orders.profile') }}">Khach hang</a>
            <a class="nav-link" href="{{ route('students.index') }}">Quan ly sinh vien</a>
            <a class="nav-link" href="{{ route('subjects.index') }}">Quan ly mon hoc</a>
            <a class="nav-link" href="{{ route('classrooms.index') }}">Quan ly lop hoc</a>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="text-center">
        <p>Copyright {{ date('Y') }} by Hoangdh9104</p>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
