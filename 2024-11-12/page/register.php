<div class="register">
    <h1>register</h1>
    <form action="" method="post">
        <input type="email" name="email" required placeholder="masukkan alamat email">
        <input type="password" name="password" required placeholder="masukkan password">
        <input type="submit" name="register" value="register">
    </form>
</div>
<?php

if (isset($_POST["register"])) {
    $email=$_POST["email"];
    $password=$_POST["password"];
    // echo $email;
    // echo '<br>';
    // echo $password;
    // echo '<br>';
    $sql="INSERT INTO customer (email,password) VALUES ('$email','$password')";
    mysqli_query($koneksi,$sql);
    header ("location:index.php?menu=login");

}

?>