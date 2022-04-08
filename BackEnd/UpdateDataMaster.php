<?php

include "api.php";
 
$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
        if ($nama == '') {
            $data['error']['edit_nama'] = 'Nama harap diisi';
        }
        if ($jenis_kelamin == '') {
            $data['error']['edit_harga'] = 'Harga harap diisi';
        }
 
        if (empty($data['error'])) {
            $query = "UPDATE stocks SET nama = '$nama', harga = '$harga' WHERE id = '$id' ";
 
            mysqli_query($koneksi, $query)
            or die ("Gagal Perintah SQL".mysql_error());
            $data['hasil'] = 'sukses';
        } else {
            $data['hasil'] = 'gagal';
        }
        echo json_encode($data);
 
?>