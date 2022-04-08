<?php
include "api.php";
 
$query = "DELETE FROM stocks WHERE id ='$_POST[id]'";
 
mysqli_query($koneksi, $query)
or die ("Gagal Perintah SQL".mysql_error());

?>