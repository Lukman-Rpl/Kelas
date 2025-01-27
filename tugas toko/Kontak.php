<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_SESSION['user'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        $email_parts = explode('@', $email);
        $email = substr($email_parts[0], 0, 3) . '***@' . $email_parts[1];

        $review = "Nama: $name\nEmail: $email\nPesan: $message\nWaktu: " . date('Y-m-d H:i:s') . "\n\n";
        file_put_contents('reviews.txt', $review, FILE_APPEND);
        $success_message = "Terima kasih, ulasan Anda telah kami terima!";
    } else {
        $error_message = "Semua kolom harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan - Retro DVD & VCD Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #c62828;
            --text-color: #333;
            --bg-color: #fafafa;
            --card-bg: #ffffff;
            --accent-color: #ffeb3b;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            border: 2px solid #000;
            box-shadow: 5px 5px 0px #000;
            margin-bottom: 30px;
        }

        .form-container {
            background-color: var(--card-bg);
            padding: 20px;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
        }

        button:hover {
            background-color: #b71c1c;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .back-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            border: 2px solid #000;
            cursor: pointer;
            font-family: "Courier New", Courier, monospace;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
            margin-top: 20px;
        }

        .back-btn:hover {
            background: #ff5252;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .success-message,
        .error-message {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 2px solid #000;
            box-shadow: 3px 3px 0px #000;
        }

        .success-message {
            background-color: #90EE90;
        }

        .error-message {
            background-color: #FFB6C1;
        }

        footer {
            background: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 3rem;
            border-top: 2px solid #000;
        }

        /* Adjusting for smaller screens */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            .header h1 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>📝 ULASAN PELANGGAN 📝</h1>
            <p>Bagikan pengalaman Anda bersama kami!</p>
        </div>

        <div class="form-container">
            <?php if (isset($_SESSION['user'])): ?>
                <?php if (!empty($success_message)): ?>
                    <div class="success-message"><?php echo $success_message; ?></div>
                <?php elseif (!empty($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form action="kontak.php" method="POST">
                    <div class="form-group">
                        <label for="name">📋 Nama:</label>
                        <input type="text" id="name" name="name" value="<?php echo $_SESSION['user']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">📧 Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="message">💭 Pesan Ulasan:</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit">📤 Kirim Ulasan</button>
                </form>
            <?php else: ?>
                <p>Silakan <a href="login_register.php" style="color: var(--primary-color); font-weight: bold;">login</a> untuk menulis ulasan.</p>
            <?php endif; ?>
        </div>

        <a href="index.php" class="back-btn">🏠 Kembali ke Beranda</a>

        <footer>
            <p>&copy; 2025 Retro DVD & VCD Store. Semua hak dilindungi.</p>
        </footer>
    </div>
</body>
</html>
