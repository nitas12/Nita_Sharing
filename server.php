<?php
$server ="localhost";
$username ="root";
$password ="";
$database ="perpus";
$con = mysqli_connect($server, $username, $password) or die ("<h1>konek mysqli error:</h1>".mysqli_connect_error());
mysqli_select_db($con, $database) or die ("<h1>konek database error:</h1>".mysqli_error($con));

@$operasi =$_GET['operasi'];
switch ($operasi){
    case 'view' :
        $tampil = mysqli_query($con, "SELECT*FROM kategori") or die (mysqli_error($con));
$data_array = array();
while ($data = mysqli_fetch_assoc($tampil)){
    $data_array[]=$data;
}
echo json_encode($data_array);
break;

    case 'insert' :
        @$nama_kategori = $_GET['nama'];
        $insert =mysqli_query($con, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
        if ($insert){
            echo "Data berhasil disimpan";
        }else{
            echo "Maaf insert data gagal :( ! ".mysqli_error($con);
        }
    break;

    case 'getbyid' :
        @$id = (int)$_GET['id'];
        $tampil = mysqli_query($con, "SELECT*FROM kategori WHERE id_kategori='$id'") or die(mysqli_error($con));
        $data_array = array ();
        $data_array = mysqli_fetch_assoc($tampil);
        echo"[".json_encode($data_array)."]";
    break;

    case 'update' :
        @$nama_kategori = $_GET['nama'];
        $id =$_GET['id'];
        $update = mysqli_query($con, "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori='$id'");
        if($update) {
            echo "update berhasil";
        
        }else{
            echo mysqli_error($con);

        }
    break;

    case 'delete' :
        @$id = $_GET['id'];
        $delete =mysqli_query($con, "DELETE FROM kategori WHERE id_kategori='$id'");
        if ($delete) {
            echo "Data berhasil dihapus";
    
        }else{
            echo mysqli_error($con);
        }
    break;
   
break;
}
?>