<?php
date_default_timezone_set("Asia/Jakarta");
include "ckoneksi.php";
// if($_SERVER['REQUEST_METHOD'] == 'POST')
//  {
 	$namaimage =  rand(1, 10000);
    $tanggal = date("Y-m-d");

    $waktumasuk=date("Y-m-d H:i:s");

 $nim = $_POST['nim'];
 $id_jadwal = $_POST['id_jadwal'];
 $ket = $_POST['ket'];
 $ImageData = $_POST['image_data'];
 $hadir = 'Hadir';

 $ImageName ="$namaimage$tanggal$nim.jpg";
 $ImagePath = "filefotomasuk/$namaimage$tanggal$nim.jpg";
 $ServerURL = "$ImagePath";
 $sql = mysqli_query($db, "SELECT * FROM tbabsen where nim='$nim' and id_jadwal='$id_jadwal' and date(waktu_masuk)='$tanggal' and date(waktu_pulang)='$tanggal'");
  if (mysqli_num_rows($sql) > 0){
  	echo "Anda Sudah Pernah Absensi";
  } else {
	 if ($ImageData=="") {		 
			 echo "No Gambar.";
	 }else{
			 $InsertSQL = "INSERT INTO tbabsen SET id_jadwal='$id_jadwal', file_masuk = '$ImageName', nim = '$nim',waktu_masuk='$waktumasuk', status='$hadir',Ket='$ket'";	 
			 if(mysqli_query($db, $InsertSQL)){
				file_put_contents($ImagePath,base64_decode($ImageData));
				echo "Absensi Sukses Dibuat.";
			 }else{
					echo "Gagal Coba Lagi";
			 }
	}
}
mysqli_close($db);
// }else{
// echo "Please Try Again";
// }
//  ?>