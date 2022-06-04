<?php
session_start();
include'../../config/koneksi.php';
include '../../config/excel_reader.php';
include '../../config/fungsi_tglindonesia.php';
//include '../../assets/excel_reader.php';
$adc = $_GET['adc'];

// function create_random($length) {
//     $data = 'abcdefghijklmnopqrstuvwxyz1234567890';
//     $string = '';
//     for ($i = 0; $i < $length; $i++) {
//         $pos = rand(0, strlen($data) - 1);
//         $string .= $data{$pos};
//     }
//     return $string;
// }
if ($adc == 'vmahasiswa') {

    $output = array('data' => array());
    $sql = mysqli_query($con, "SELECT * FROM tbmahasiswa a, tbsemester b where a.id_semester=b.id_semester");

    $no = 1;
    
    while ($row = mysqli_fetch_array($sql)) {
            $nomor="$no";
            $nama_mahasiswa="$row[nama_mahasiswa]";
            $nama_semester="$row[nama_semester]";
            $nim="$row[nim]";
            if ($row['foto']=="") {
                $foto='<a href="android/foto_mahasiswa/noimage.png"><img src="android/foto_mahasiswa/noimage.png" class="img-responsive" alt="Image" style="height:50px;"></a>';
            }else{
                $foto='<a href="android/foto_mahasiswa/'.$row['foto'].'"><img src="android/foto_mahasiswa/'.$row['foto'].'" class="img-responsive" alt="Image" style="height:50px;"></a>';
            }
            
            $opsi = '<button type="button" class="btn btn-primary" data-toggle="modal" href="#edtmahasiswa" onclick="editData(' . $row['nim'] . ')"> <i class="icon icon-pencil"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" href="#konfirmasi_hapusmahasiswa" onclick="hapusData(' . $row['nim'] . ')"><i class="icon icon-trash"></i></button>';
        $output['data'][] = array(
            $nomor,
            $nim,
            $nama_mahasiswa,
            $nama_semester,
            $foto,
            $opsi
        );
        $no++;
    }
    $con->close();
    echo json_encode($output);
} else if ($adc == 'smahasiswa') {    
    $nim    = $_POST['nim'];
    $nama_mahasiswa    = $_POST['nama_mahasiswa'];
    $id_semester    = $_POST['id_semester'];
    $password    = $_POST['password'];

    $nama_gambar    = $_FILES['uploadfoto']['name'];
    $lokasi_gambar  = $_FILES['uploadfoto']['tmp_name'];
   // $tipe_gambar    = $_FILES['uploadberkasmasuk']['type'];

    $c=explode(".",$nama_gambar);
    $ext = end($c);
    $namauploadberkasm = md5(rand()) . '.' . $ext;
    if($lokasi_gambar==""){
        $sql    = mysqli_query($con, "INSERT INTO `tbmahasiswa`(`nim`,`nama_mahasiswa`,`password`,`id_semester`) VALUES ('$nim','$nama_mahasiswa','$password','$id_semester')"); 
    }else{  
         move_uploaded_file($lokasi_gambar,"../../android/foto_mahasiswa/$namauploadberkasm");
        $sql    = mysqli_query($con, "INSERT INTO `tbmahasiswa`(`nim`,`nama_mahasiswa`,`password`,`id_semester`,`foto`) VALUES ('$nim','$nama_mahasiswa','$password','$id_semester','$namauploadberkasm')"); 
    }  
   
        if ($sql) {
            echo "1";
        } else {
            echo "0";
        }  
    
} else if ($adc == 'editmahasiswa') {

    $nama_mahasiswa    = $_POST['enama_mahasiswa'];
    $id_semester    = $_POST['eid_semester'];
    $id     = $_POST['id'];

    $nama_gambar    = $_FILES['euploadfoto']['name'];
    $lokasi_gambar  = $_FILES['euploadfoto']['tmp_name'];
  //  $tipe_gambar    = $_FILES['euploadberkasmasuk']['type'];


    $c=explode(".",$nama_gambar);
    $ext = end($c);
    $namauploadberkasm = md5(rand()) . '.' . $ext;

    

    if($lokasi_gambar==""){
         $sql    = mysqli_query($con, "UPDATE tbmahasiswa SET nama_mahasiswa='$nama_mahasiswa',id_semester='$id_semester' WHERE nim='$id'");
    }else{
          $data = mysqli_fetch_array(mysqli_query($con, "SELECT * from tbmahasiswa where nim='$id'"));
          if($data['foto'] != 0) unlink("../../android/foto_mahasiswa/$data[foto]");
          move_uploaded_file($lokasi_gambar,"../../android/foto_mahasiswa/$namauploadberkasm");
          $sql    = mysqli_query($con, "UPDATE tbmahasiswa SET nama_mahasiswa='$nama_mahasiswa',id_semester='$id_semester',foto='$namauploadberkasm' WHERE nim='$id'");
    }
   
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($adc == 'hmahasiswa') {

     $id = $_POST['id'];
     $data = mysqli_fetch_array(mysqli_query($con, "SELECT * from tbmahasiswa where nim='$id'"));
          if($data['foto'] != 0) unlink("../../android/foto_mahasiswa/$data[foto]");
    $sql = mysqli_query($con, "DELETE FROM tbmahasiswa WHERE nim='$id'") or die(mysqli_error());
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}elseif ($adc == 'edmahasiswa') {
    $id     = $_POST['id'];

    $sql    = "SELECT * FROM tbmahasiswa WHERE nim ='$id'";
    $query  = $con->query($sql);
    $result = $query->fetch_assoc();
    //tutup koneksi
    $con->close();

    echo json_encode($result);
}
?>