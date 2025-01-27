<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>

    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>View Customers</h1>
            <p>Here you can see all the customers who have registered.</p>
        </header>

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin_home.php">Admin Dashboard</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_customer.php">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Customers List -->
        <h2>Registered Customers</h2>
        <ul class="list-group">
            <li class="list-group-item">
                Customer 1 - Email: customer1@example.com
            </li>
            <li class="list-group-item">
                Customer 2 - Email: customer2@example.com
            </li>
            <!-- Add customers dynamically here -->
        </ul>
    </div>

</body>
</html>