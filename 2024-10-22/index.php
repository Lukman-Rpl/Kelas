<?php

$data="saya belajar di SMKN 2 Buduran ";
$isi="hari ini saya belajar php";
$materi=" materi belajar php";

$sekolah=["tk dharmawanita","sdn banjarkemantren","smpn 1 buduran","smk negeri 2 buduran"];
$identitas=[""];
$judul=[""];
$hobies=[""];
$skills="php newbie";

$list1="variabel";
$list2="array";
$list3="pengujian";
$list4="pengulangan";
$list5="function";
$list6="class";
$list7="object";
$list8="framework";
$list9="php dan mysql";
$lists=["varibael","array","pengujian","pengulangan","function","class","object","framework","php dan mysql"];
echo $data;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .kamar{
           text-align:center;
          
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><? $judul; ?></h1>
    </div>
    <div class="identitas">
        <table>
            <thead></thead>
            <tbody>
                <tr>
                    <td> nama</td>
                    <td><?= $identitas[0] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="kamar">
        <h1><?php echo $data;?></h1>
        <p>hari ini saya Belajar php</p>
        <h2>materi php</h2>
        <ol>
            <li><?=$lists[0] ?></li>
            <p>variabel adalah wadah untuk menyimpan data </p>
            <p>Data bisa berupa text atau string,bisa juga berupa angka atau numerik,data juga bisa berupa gabungan antara text,angka dan symbol</p>
            <li><?=$lists[1] ?></li>
            <li><?=$lists[2] ?></li>
            <li><?=$lists[3] ?></li>
            <li><?=$lists[4] ?></li>
            <li><?=$lists[5] ?></li>
            <li><?=$lists[6] ?></li>
            <li><?=$lists[7] ?></li>
            <li><?=$lists[8] ?></li>
        </ol>
    </div>
</body>
</html>