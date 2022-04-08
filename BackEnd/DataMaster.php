    <table class="table table-bordered">
        <tr>
            <th width="5%" class="text-center">No</th>
            <th width="50%">Nama Barang</th>
            <th width="30%" class="text-center">Harga</th>
            <th width="15%" class="text-center">Aksi</th>
        </tr>
            <?php
                include "api.php";
                $no = 1;
                $data = mysqli_query ($koneksi, " SELECT * FROM stocks ");
                while ($row = mysqli_fetch_array ($data))
                {
            ?>
        <tr>
            <td>
                <?php echo $no++; ?>
            </td>
            <td>
                <?php echo $row['nama']; ?>
            </td>
            <td>
                <?php echo $row['harga']; ?>
            </td>
            <td>

            </td>
        </tr>
        <?php
            }
        ?>
    </table>