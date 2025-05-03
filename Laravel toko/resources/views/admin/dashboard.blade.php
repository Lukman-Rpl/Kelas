<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Retro DVD & VCD Store</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            width: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        /* Navbar Styling */
        nav.navbar {
            background-color: #2c3e50;
            color: white;
            border-radius: 8px;
            padding: 15px 30px;
        }

        .navbar-brand, .nav-link {
            color: #ecf0f1 !important;
            font-weight: 600;
        }

        .nav-link:hover {
            color: #f1c40f !important;
        }

        header {
            background-color: #34495e;
            color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .card {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            padding: 20px;
            border-radius: 10px;
            height: 100%;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .btn {
            width: 100%;
            padding: 10px 0;
            font-weight: 600;
        }

        .container {
            padding-left: 30px;
            padding-right: 30px;
        }

        .row {
            gap: 20px;
            justify-content: center;
        }

        .col-md-3 {
            min-width: 250px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <header class="text-center">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the admin panel of Retro DVD & VCD Store.</p>
    </header>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg shadow-sm mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Cards -->
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Products</h5>
                    <a href="{{ url('admin/product') }}" class="btn btn-outline-primary">Go to Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">View Customers</h5>
                    <a href="{{ url('admin/customers') }}" class="btn btn-outline-success">Registered Users</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Banner</h5>
                    <a href="{{ url('admin/banner') }}" class="btn btn-outline-warning">Change Banner</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Checkout List</h5>
                    <a href="{{ url('admin/checkoutlist') }}" class="btn btn-outline-danger">View & Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
