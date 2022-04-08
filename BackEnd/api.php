<?php
$serverhost = "localhost";
$serverusername = "root"; 
$serverpassword = "";         
$serverdatabase = "kasir_uts";
$koneksi = new mysqli($serverhost, $serverusername, $serverpassword, $serverdatabase);

    header('Access-Control-Allow-Origin: *'); 
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type');

$response = array();
if (isset($_GET['method'])){
    $method =$_GET['method'];
    switch($method){
        case "getAllDataMaster" :
            //get url situs
            $sql = "SELECT * FROM `stocks` ORDER BY `nama`";
            $query = mysqli_query($koneksi, $sql);
            if(!empty($query)){
                $jumlah = mysqli_num_rows($query);
                if($jumlah>0){
                    $response["data"] = array();
                    while($hasil = mysqli_fetch_row($query)){
                    $data = array();
                    $data["id"] = $hasil[0];
                    $data["nama"] = $hasil[1];  
                    $data["harga"] = $hasil[2];                 
                    // push data ke response array
                    array_push($response["data"], $data);
                    }
                    // success
                    $response["success"] = 1;
                    
                    // echoing JSON response
                    echo json_encode($response);
                }else{
                    //data tidak ditemukan
                    $response["success"] = 0;
                    $response["message"] = "Data Tidak Ditemukan"; 
                    // echoing JSON response
                    echo json_encode($response);
                }
            }else{
                //data tidak ditemukan
                $response["success"] = 0;
                $response["message"] = "Kesalahan Koneksi"; 
                // echoing JSON response
                echo json_encode($response);
            }
        break;
        
        case "InsertDataMaster" : 
            // $fill_nama = $_POST['nama'];
            // $fill_harga = $_POST['harga'];
            // $query = mysqli_query($koneksi,"INSERT INTO stocks (nama,harga) VALUES ('$fill_nama','$fill_harga')");

            // if($query) // jika insert data berhasil
            // {
            //     // fungsi untuk membuat format json
            //     header('Content-Type: application/json');
            //     // untuk load data yang sudah ada dari tabel
            //     $content = file_get_contents('http://localhost/Pemweb_UTS/FrontEnd/index.html', true);
            //     $data = array('status'=>'success', 'data'=> $content);
            //     echo json_encode($data);
            // }
            // else // jika insert data gagal
            // {
            //     $data = array('status'=>'failed', 'data'=> null);
            //     echo json_encode($data);
            // }  
            $response = json_decode(file_get_contents('php://input'),TRUE); 
            if($response['success']==1){
            
                // $kategori_buku = $response['kategori_buku'];

                $nama = $response['fill_nama'];
                $harga = $response['fill_harga'];

                // $sql = "INSERT INTO `kategori_buku` (`kategori_buku`) VALUES ('$kategori_buku')";
                $sql = "INSERT INTO stocks (nama,harga) VALUES ('$nama','$harga')";
                $query = mysqli_query($koneksi,$sql);
                if(!empty($query)){
                    // success      
                    $id = mysqli_insert_id($koneksi);
                    //get jumlah 
                    $sql_j = "SELECT * FROM `stocks`";
                    $query_j = mysqli_query($koneksi,$sql_j);
                    $jumlah = mysqli_num_rows($query_j);

                    $response["success"] = 1;    
                    $response["data"] = $id;
                    $response["jumlah"] = $jumlah;
                    // echoing JSON response
                    echo json_encode($response);
                }else{
                    //data tidak ditemukan
                    $response["success"] = 0;
                    $response["message"] = "Kesalahan Koneksi"; 
                    // echoing JSON response
                    echo json_encode($response);
                }
                        
            }else{
                //data tidak ditemukan
                $response["success"] = 0;
                $response["message"] = "Terjadi Kesalahan Data"; 
                // echoing JSON response
                echo json_encode($response);
            }
              
        break;

        case "getSearchKategoriBuku" :   
            $response = json_decode(file_get_contents('php://input'),TRUE); 
            if($response['success']==1){            
                $kata_kunci = $response['kata_kunci'];
                $sql = "SELECT `id_kategori_buku`, `kategori_buku` FROM `kategori_buku` 
                WHERE `kategori_buku` LIKE '%$kata_kunci%' ORDER BY `kategori_buku`";
                $query = mysqli_query($koneksi, $sql);
                if(!empty($query)){
                    $jumlah = mysqli_num_rows($query);
                    if($jumlah>0){
                        $response["data"] = array();
                        while($hasil = mysqli_fetch_row($query)){
                        $data = array();
                        $data["id_kategori_buku"] = $hasil[0];  
                        $data["kategori_buku"] = $hasil[1];                 
                        // push data ke response array
                        array_push($response["data"], $data);
                        }
                        // success
                        $response["success"] = 1;                        
                        // echoing JSON response
                        echo json_encode($response);
                    }else{
                        //data tidak ditemukan
                        $response["success"] = 0;
                        $response["message"] = "Kesalahan Koneksi"; 
                        // echoing JSON response
                        echo json_encode($response);
                    }                   
                        
                }else{
                    //data tidak ditemukan
                    $response["success"] = 0;
                    $response["message"] = "Terjadi Kesalahan Data"; 
                    // echoing JSON response
                    echo json_encode($response);
                }
            }else{
                //data tidak ditemukan
                $response["success"] = 0;
                $response["message"] = "Terjadi Kesalahan Data"; 
                // echoing JSON response
                echo json_encode($response);
            }
              
        break;

        case "getDataMaster" :
            if (isset($_GET['id'])){
                $id = $_GET['id'];
                //get url situs
                $sql = "SELECT * FROM `stocks` WHERE `id`='$id'";
                $query = mysqli_query($koneksi, $sql);
                if(!empty($query)){
                    $jumlah = mysqli_num_rows($query);
                    if($jumlah>0){
                        $response["data"] = array();
                        while($hasil = mysqli_fetch_row($query)){
                        $data = array();
                        $data["id"] = $hasil[0];
                        $data["nama"] = $hasil[1];
                        $data["harga"] = $hasil[2];                 
                        // push data ke response array
                        array_push($response["data"], $data);
                        }
                        // success
                        $response["success"] = 1;
                        
                        // echoing JSON response
                        echo json_encode($response);
                    }else{
                        //data tidak ditemukan
                        $response["success"] = 0;
                        $response["message"] = "Data Tidak Ditemukan"; 
                        // echoing JSON response
                        echo json_encode($response);
                    }
                }else{
                    //data tidak ditemukan
                    $response["success"] = 0;
                    $response["message"] = "Kesalahan Koneksi"; 
                    // echoing JSON response
                    echo json_encode($response);
                }

            }else{
                //data tidak ditemukan
                $response["success"] = 0;
                $response["message"] = "Terjadi Kesalahan Data"; 
                // echoing JSON response
                echo json_encode($response);
            }
        break;

        case "DeleteDataMaster" :
            $response = json_decode(file_get_contents('php://input'),TRUE); 
            if($response['success']==1){
                $id = $response['id'];
                //get url situs
                $sql = "DELETE FROM `stocks` WHERE `id`='$id'";
                $query = mysqli_query($koneksi, $sql);
                if(!empty($query)){
                        // success
                        $response["success"] = 1;
                        
                        // echoing JSON response
                        echo json_encode($response);
                }else{
                    //data tidak ditemukan
                    $response["success"] = 0;
                    $response["message"] = "Kesalahan Koneksi"; 
                    // echoing JSON response
                    echo json_encode($response);
                }

            }else{
                //data tidak ditemukan
                $response["success"] = 0;
                $response["message"] = "Terjadi Kesalahan Data"; 
                // echoing JSON response
                echo json_encode($response);
            }
        break;

        case "UpdateDataMaster" :   
            $response = json_decode(file_get_contents('php://input'),TRUE); 
            if($response['success']==1){
                $id = $response['id'];
                $nama = $response['edit_nama'];
                $harga = $response['edit_harga'];
                
                $sql = "UPDATE  `stocks` SET `nama`='$nama',`harga`='$harga' WHERE `id`='$id'";
                $query = mysqli_query($koneksi, $sql);
                if(!empty($query)){
                        // success
                        $response["success"] = 1;                        
                        // echoing JSON response
                        echo json_encode($response);
                }else{
                    //data tidak ditemukan
                    $response["success"] = 0;
                    $response["message"] = "Kesalahan Koneksi"; 
                    // echoing JSON response
                    echo json_encode($response);
                }
                       
            }else{
                //data tidak ditemukan
                $response["success"] = 0;
                $response["message"] = "Terjadi Kesalahan Data"; 
                // echoing JSON response
                echo json_encode($response);
            }      
        break;

        default:
            $response["success"] = 0;
            $response["message"] = "Metode Request Salah";
            // echoing JSON response
            echo json_encode($response);
        break;
    
    }
}else{
    $response["success"] = 0;
    $response["message"] = "Metode Tidak Ada";
    // echoing JSON response
    echo json_encode($response);
}

?>