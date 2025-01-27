<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>

    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Manage Products</h1>
            <p>Here you can add, edit, or delete products.</p>
        </header>

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin_home.php">Admin Dashboard</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Product Form -->
        <form method="POST" action="process_product.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <h2 class="mt-5">Existing Products</h2>
        <!-- Existing Products List -->
        <ul class="list-group">
            <li class="list-group-item">
                Product 1 <a href="edit_product.html?id=1" class="btn btn-warning btn-sm ms-3">Edit</a> <a href="delete_product.php?id=1" class="btn btn-danger btn-sm ms-2">Delete</a>
            </li>
            <li class="list-group-item">
                Product 2 <a href="edit_product.html?id=2" class="btn btn-warning btn-sm ms-3">Edit</a> <a href="delete_product.php?id=2" class="btn btn-danger btn-sm ms-2">Delete</a>
            </li>
            <!-- More products can be listed dynamically here -->
        </ul>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybRr9kC2G7V4v/9fX9g9zE5fll5y/x6RIp5d3/zM8jIU6Wv8g" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0eI7kfaTNTIITy4z6tbfWdyFzVJl6V2p6Lpj9Em2F7js1l9J" crossorigin="anonymous"></script>
</body>
</html>
