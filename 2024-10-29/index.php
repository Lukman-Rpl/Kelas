<?php
$sekolah=["TK Dharmawanita","SDN Banjarkemantren 1","SMPN 1 Buduran","SMKN 2 Buduran"];//array 1 dimensi
$sekolahs=["tk"=>"TK Dharmawanita","SD"=>"SDN banjarkemantren 1","SMP"=>"SMPN 1 Buduran","SMK"=>"SMKN 2 Buduran","Pt"=>"Umsida"];
$skills=["c++"=> "expert","html"=>"newbie","css"=>"intermediate","php"=>"intermediate","javascript"=>"intermediate"];
$identitas=["nama"=>"Lukman Ghoffur N.R","Alamat"=>"jambe lor rt.10 rw.02","email"=>"lukmanghoffur4@gmail.com","facebook"=>"@screthamong","instagram"=>"@lukman_ghf"];
$hobi=["coding","main musik","mancing","sepeda","membaca"];


// echo $sekolah[0];
// echo "<br>";
// echo $sekolahs["tk"];
// echo "<br>";
// echo $sekolah[1];
// echo"<br>";
// echo $sekolahs ["SD"];
// echo "<br>";

// for ($i=0; $i < 4; $i++){
// echo $sekolah[$i];
// echo "<br>";
// }

// foreach ($sekolah as $key){
//     echo $key;
//     echo "<br>";
// }

// foreach($sekolahs as $key => $value){
//     echo $key;
//     echo "=";
//     echo $value;
//     echo "<br>";
// }

// foreach ($skills as $key=> $value){
//     echo $key;
//     echo "=";  
//     echo $value;
//     echo "<br>";
// }

if (isset($_GET["menu"])) {
    $menu=$_GET["menu"];
    echo $menu;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <hr>
    <ul>
        <li><a href="?menu=home">home</a></li>
        <li><a href="?menu=cv">cv</a></li>
        <li><a href="?menu=project">project</a></li>
        <li><a href="?menu=contact">contact</a></li>
    </ul>
    <h2>riwayat sekolah</h2>

    <table border="1px">
        <thead>
            <tr>
                <th> jenjang </th>
                <th> nama sekolah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($sekolahs as $key => $value){
                echo "<tr>";
                echo "<td>";
                echo $key;
                echo "</td>";
                echo "<td>";
                echo $value;
                echo "</td>";
                echo "</tr>";
            }
            
            ?>
        </tbody>
    </table>
    <hr>
    <h2>skills</h2>
    <table border="1px">
        <thead>
            <tr>
                <th>skill</th>
                <th>level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($skills as $key => $value) {
                ?>
                <tr>
            <td><?=$key ?></td>
            <td><?=$value ?></td>
          </tr>
                <?php  
            }
           ?>
          
        </tbody>
    </table>
<hr>
<h2>identitas</h2>
<table border="1px">
    <thead>
        <tr>
            <th>identitas</th>
            <th>deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($identitas as $key => $value) {
            ?>
            <tr>
                <td><?=$key ?></td>
                <td><?=$value ?> </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<hr>
<ol>
    <?php
    foreach ($hobi as $key ) {
        ?>
        <li><?=$key ?></li>
        <?php
    } 
    ?>
</ol>
</body>
</html>