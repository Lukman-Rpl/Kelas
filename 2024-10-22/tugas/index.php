<?php
$n="LUKMAN GHOOFUR NUR ROHIM";
$al= "Jambe lor Rt.10 Rw.02";
$dt=["Pria","171 cm","58 kg"];
$nh="08818557238";
$h="Membaca dan Gaming";
$pendidikan=["SDN Banjarkemantren 01","SMPN 1 Buduran","SMKN 2 Buduran"]

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="luar">
        <div class="judul"><h1>CURICCULUM VITAE</h1></div>
        <div class="identitas">
            <hr>
            <h1>IDENTITAS</h1>
            <hr>
            <div class="nama">
                <p>Nama  &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; :<?=$n?></p>
            </div>
            <div class="alamat">
                <p>Alamat  &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &ensp; :<?php echo $al;?></p>
            </div>
             <div class="gender">
                <p> jenis kelamin &emsp; &emsp; &emsp; &emsp; &ensp;  : <?=$dt[0]?>
            </p>
             </div>
             <div class="tb">
                <p> Tinggi Badan &emsp; &emsp; &emsp; &emsp; &ensp;  :<?=$dt[1]?></p>
             </div>
             <div class="bb">
                <p>Berat Badan &emsp; &emsp; &emsp; &emsp; &emsp; :<?=$dt[2]?></p>
             </div>
             <div class="nomer">
                <p> No.Handphone &emsp; &emsp; &ensp; &emsp; &nbsp; :<?php echo $nh?></p>
             </div>
              <div class="hobi">
                <p>Hobi  &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &ensp; &ensp; :<?php echo $h?></p>
              </div>
        </div>
        <div class="gambar">
            <img src="../img/data_diri.jpg" alt="">
        </div>
        <div class="pendidikan">
            <div class="judul-2">
              <hr>
             <h1>PENDIDIKAN</h1>
            <hr>
            </div>
            <div class="formal">
                <h2><strong>Formal</strong></h2>
            <div class="sd">
                <p> SD &emsp; &emsp; &emsp; :<?=$pendidikan[0]?></p>
            </div>
            <div class="smp">
               <p>SMP &emsp; &emsp; &nbsp; :<?=$pendidikan[1]?></p> 
            </div>
            <div class="smk">
                <p>SMK &ensp; &ensp; &ensp; &nbsp; :<?=$pendidikan[2]?></p>
            </div>
            <hr>
            <div class="non-formal">
               <h2> Non-Formal : </h2>
               <p>tidak ada</p>
            </div>
            <hr>
            </div>
            
        </div>
    </div>
</body>
</html>