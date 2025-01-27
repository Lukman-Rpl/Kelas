<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi

// Redirect ke halaman beranda setelah logout
header("Location: index.php");
exit();
?>