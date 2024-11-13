<?php

$host="127.0.0.1";
$user="root";
$password="";
$database="sekolah";

$koneksi= mysqli_connect($host,$user,$password,$database);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 2 Buduran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt=""></a>
            </div>
            
            <div class="sekolah">
                <h2>SMKN 2 Buduran</h2>
            </div>
            <div class="nav">
                 <ul>
                    <li><a href="?menu=home">home</a></li>
                    <li><a href="?menu=tentang">tentang</a></li>
                    <li><a href="?menu=sejarah">sejarah</a></li>
                    <li><a href="?menu=jadwal">jadwal</a></li>
                    <li><a href="?menu=jurusan">jurusan</a></li>
                    <li><a href="?menu=kontak">kontak</a></li>
                </ul> 
            </div>
        </div>
        <div class="content">
<?php
if (isset($_GET['menu'])) {
    $menu=$_GET['menu'];
    echo $menu;
    if ($menu=='home') {
       require_once ("pages/home.php");
    }
    if ($menu=='tentang') {
        require_once ("pages/tentang.php");
    }
    if ($menu=='sejarah') {
        require_once ("pages/sejarah.php");
    }
    if ($menu=='kontak') {
        require_once ("pages/kontak.php");
    }
    if ($menu=='jadwal') {
        require_once ("pages/jadwal.php");
    }
    if ($menu=='jurusan') {
         require_once ("pages/jurusan.php");
    }
}
else{require_once ("pages/home.php");
}
//require_once ("pages/home.php");

?>
        </div>
        <div class="footer">
            <p>web ini dibuat oleh:Lukman Ghoffur N.R</p>
        </div>
    </div>
</body>
</html>