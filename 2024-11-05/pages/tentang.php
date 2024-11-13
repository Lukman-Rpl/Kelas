<?php
$sql="SELECT * FROM tentang";
$hasil= mysqli_query($koneksi,$sql);
while ($row= mysqli_fetch_array($hasil)) {
    echo '<div class="tentang">';
   echo '<h2>'.$row[1].'<h2>';
    echo '<p>'.$row[2].'</p>';
    echo '</div>';
}

?>




