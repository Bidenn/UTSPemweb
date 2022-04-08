<?php
    include "api.php";
    $no = 1;
    $data = mysqli_query ($koneksi, " SELECT * FROM stocks WHERE id = $_POST[id]");
    $row = mysqli_fetch_array ($data);
?>
<form role="form" id="FormEditDataMaster" method="POST" action="UpdateDataMaster.php">
    <div class="modal-header">             
        <h4 class="modal-title">Edit Barang</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Nama</label>
            <input type="hidden" name="id" value="<?php echo $row['id'] ; ?>">
            <input class="form-control" name="nama" value="<?php echo $row['nama'] ; ?>">
            <p style="color:red" id="error_edit_nama"></p>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input class="form-control" name="harga" value="<?php echo $row['harga'] ; ?>">
            <p style="color:red" id="error_edit_harga"></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
   
</form>