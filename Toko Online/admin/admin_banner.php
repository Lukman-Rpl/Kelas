<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Banner - Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Change Store Banner</h1>
            <p>Upload a new banner for the store.</p>
        </header>

        <nav class="navbar">
            <div class="nav-container">
                <a href="admin_home.php">Home</a>
                <a href="admin_banner.php">Banner</a>
                <a href="index.php">Logout</a>
            </div>
        </nav>

        <div class="banner-form">
            <form method="POST" action="upload_banner.php" enctype="multipart/form-data">
                <label for="banner">Choose Banner Image:</label>
                <input type="file" id="banner" name="banner" required>

                <button type="submit">Upload Banner</button>
            </form>
        </div>
    </div>
</body>
</html>
