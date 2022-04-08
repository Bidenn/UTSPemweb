<?php
	include 'api.php';
	$fill_nama=$_POST['nama'];
	$fill_harga=$_POST['harga'];
	$sql = "INSERT INTO `stocks`( `nama`, `harga`) VALUES ('$nama','$harga')";
	if (mysqli_query($koneksi, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>