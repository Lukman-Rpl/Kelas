
<div class="login">
<h1>login</h1>
<form action="" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="password" required>
    <input type="submit" name="login" value="login">
</form>    
    
</div>
<?php

if (isset($_POST["login"])) {
    $email=$_POST["email"];
    $password=$_POST["password"];

    $sql="SELECT * FROM customer WHERE email='$email' AND password='$password'";
    $hasil=mysqli_query($koneksi, $sql);
    $baris=mysqli_num_rows($hasil);

    if ($baris==0) {
        echo '<h2>email atau password salah</h2>';
    }
    else {
        $_SESSION["email"]=$email;
        header("location:index.php");
    }

}

?>