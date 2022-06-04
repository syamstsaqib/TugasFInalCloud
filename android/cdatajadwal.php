<?php
include "ckoneksi.php";
$nim =  $_GET['nim'];

$hasilsmt = mysqli_query($db,"SELECT * from tbmahasiswa where nim = '$nim'");
$datasmt = mysqli_fetch_array($hasilsmt);
// $nim =  666;
$query = "SELECT * from tbjadwal where id_semester = '$datasmt[id_semester]'";

$hasil = mysqli_query($db,$query);
if (mysqli_num_rows($hasil) > 0) {
$response = array();
$response["djadwal"] = array();
while ($data = mysqli_fetch_array($hasil))
{

$matakuliah = mysqli_query($db,"SELECT * from tbmatkul where id_matkul = '$data[id_matkul]'");
$datamatakuliah = mysqli_fetch_array($matakuliah);
$kelas = mysqli_query($db,"SELECT * from tbruang where id_ruang = '$data[id_ruang]'");
$datakelas = mysqli_fetch_array($kelas);
$dosen = mysqli_query($db,"SELECT * from tbdosen where nip = '$data[nip]'");
$datadosen = mysqli_fetch_array($dosen);

$h['id_jadwal']    	  	= $data['id_jadwal'] ;
$h['nama_matkul']   		= $datamatakuliah['nama_matkul'] ;
$h['nama_ruang']   		= 'Ruang :'.$datakelas['nama_ruang'] ;
$h['nama_dosen']   		= $datadosen['nama_dosen'] ;
$h['hari']   		= $data['hari'] ;
$h['jam_awal']   		= $data['jam_awal'] ;
$h['jam_akhir']   		= $data['jam_akhir'] ;

 array_push($response["djadwal"], $h);
}
	$response["success"] = "1";
	echo json_encode($response);
}
else {
    $response["success"] = "0";
    $response["message"] = "Tidak ada data";
	echo json_encode($response);
}
?>