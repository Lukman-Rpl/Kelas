<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout List - Admin</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <header class="header">
            <h1 class="text-center">Checkout List</h1>
            <p class="text-center">Here you can manage the checkout list and delete entries.</p>
        </header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="admin_home.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_checkoutlist.php">Checkout List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="checkout-list mt-4">
            <h2>Submitted Checkouts</h2>
            <!-- A list of submitted checkouts would be fetched from the database -->
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Order 1 - Customer: John Doe 
                    <a href="delete_checkout.php?id=1" class="btn btn-danger btn-sm">Delete</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Order 2 - Customer: Jane Doe 
                    <a href="delete_checkout.php?id=2" class="btn btn-danger btn-sm">Delete</a>
                </li>
                <!-- Add more orders dynamically here -->
            </ul>
        </div>
    </div>
</body>
</html>
