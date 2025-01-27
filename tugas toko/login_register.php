<?php    
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'dbdvc'; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;  // Menyimpan nama pengguna di sesi
        $user_data = $result->fetch_assoc();
        $_SESSION['email'] = $user_data['email']; // Menyimpan email pengguna di sesi
        $_SESSION['role'] = $user_data['role'];  // Menyimpan role pengguna di sesi

        // Redirect berdasarkan role
        if ($_SESSION['role'] == 'admin') {
            header("Location: index.php");  // Redirect ke dashboard admin
        } else {
            header("Location: index.php");  // Redirect ke halaman utama pengguna biasa
        }
        exit();
    } else {
        $loginError = "Username atau password salah!";
    }
}

// Menangani proses registrasi
if (isset($_POST['register'])) {
    $username = $_POST['reg_username'];
    $password = $_POST['reg_password'];
    $confirmPassword = $_POST['reg_confirm_password'];
    $email = $_POST['reg_email']; // Menambahkan email ke variabel registrasi
    $role = 'user';  // Default role adalah 'user'

    if ($password === $confirmPassword) {
        // Cek apakah username sudah terdaftar
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 0) {
            // Menyimpan data pengguna baru
            $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
            if ($conn->query($sql) === TRUE) {
                $registerSuccess = "Pendaftaran berhasil! Silakan login.";
            } else {
                $registerError = "Terjadi kesalahan saat mendaftar. Coba lagi.";
            }
        } else {
            $registerError = "Username sudah terdaftar!";
        }
    } else {
        $registerError = "Password dan konfirmasi password tidak cocok!";
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Retro DVD & VCD Store</title>
    
    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #c62828;
            --text-color: #333;
            --bg-color: #fafafa;
            --card-bg: #ffffff;
            --accent-color: #gold;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), #303f9f);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .header p {
            text-align: center;
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .navbar {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar a {
            color: var(--text-color);
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
            font-weight: 600;
        }

        .navbar a:hover {
            color: var(--secondary-color);
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background: var(--secondary-color); /* Secondary color for the buttons */
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #b71c1c; /* Darker shade of red for hover effect */
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .back-home {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background: var(--primary-color); /* Primary color for the back button */
            color: white;
            text-align: center;
            font-weight: bold;
            border: none;
            cursor: pointer;
            box-shadow: 3px 3px 0px #000;
            transition: background 0.3s ease;
        }

        .back-home:hover {
            background: #0d47a1; /* Darker shade of primary color for hover effect */
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .toggle-register {
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .navbar {
                padding: 1rem 0;
            }

            .navbar a {
                padding: 0.5rem 1rem;
            }

            .form-container {
                padding: 15px;
            }
        }
    </style>

    <script>
        function toggleForm() {
            var loginForm = document.getElementById('login-form');
            var registerForm = document.getElementById('register-form');
            if (loginForm.style.display === "none") {
                loginForm.style.display = "block";
                registerForm.style.display = "none";
            } else {
                loginForm.style.display = "none";
                registerForm.style.display = "block";
            }
        }

        window.onload = function() {
            // Mengambil role pengguna dari PHP dan memanipulasi elemen berdasarkan role
            var userRole = '<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>';

            if (userRole === 'admin') {
                // Tampilkan dashboard admin jika admin
                document.getElementById('admin-link').style.display = 'inline-block';
            } else if (userRole === 'user') {
                // Menampilkan link pengguna biasa
                document.getElementById('user-link').style.display = 'inline-block';
            }
        }
    </script>
</head>
<body>

    <div class="container">
        <header class="header">
            <h1>🎬 RETRO DVD & VCD STORE 📀</h1>
            <p>Koleksi Film Klasik Terlengkap!</p>
        </header>

        <div class="form-container">
            <!-- Form Login -->
            <div id="login-form">
                <h2>Login</h2>
                <form method="POST" action="">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login">Login</button>
                </form>
                <?php if (isset($loginError)) { echo "<p>$loginError</p>"; } ?>
                <p class="toggle-register" onclick="toggleForm()">Belum punya akun? Daftar di sini</p>
            </div>

            <!-- Form Register -->
            <div id="register-form" style="display: none;">
                <h2>Register</h2>
                <form method="POST" action="">
                    <input type="text" name="reg_username" placeholder="Username" required>
                    <input type="email" name="reg_email" placeholder="Email" required> <!-- Tambahkan input email -->
                    <input type="password" name="reg_password" placeholder="Password" required>
                    <input type="password" name="reg_confirm_password" placeholder="Konfirmasi Password" required>
                    <button type="submit" name="register">Register</button>
                </form>
                <?php 
                if (isset($registerError)) { 
                    echo "<p>$registerError</p>";
                } 
                if (isset($registerSuccess)) { 
                    echo "<p class='success'>$registerSuccess</p>";
                }
                ?>
                <p class="toggle-register" onclick="toggleForm()">Sudah punya akun? Login di sini</p>
            </div>
        </div>

        <!-- Tombol Kembali ke Beranda -->
        <a href="index.php">
            <button class="back-home">Kembali ke Beranda</button>
        </a>
    </div>
</body>
</html>
