<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Retro DVD & VCD Store</title>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <header class="text-center mb-5">
            <h1>Admin Dashboard</h1>
            <p>Welcome to the admin panel of Retro DVD & VCD Store.</p>
        </header>

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin_home.php">Admin Dashboard</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Products</h5>
                        <a href="admin_products.php" class="btn btn-primary">Add / Edit / Delete</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">View Customers</h5>
                        <a href="admin_customer.php" class="btn btn-primary">View Registered Users</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Banner</h5>
                        <a href="admin_banner.php" class="btn btn-primary">Change Banner Image</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Checkout List</h5>
                        <a href="admin_checkoutlist.php" class="btn btn-primary">View and Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
