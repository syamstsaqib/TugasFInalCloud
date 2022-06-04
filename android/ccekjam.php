<?php
date_default_timezone_set("Asia/Jakarta");
include_once 'ckoneksi.php';
	$nim =  $_POST['nim'];
	$hasilsmt = mysqli_query($db,"SELECT * from tbmahasiswa where nim = '$nim'");
	$datasmt = mysqli_fetch_array($hasilsmt);
	$id_semester=$datasmt['id_semester'];


function conHari($hari){  switch($hari){  case 'Sun':   $getHari = "Minggu";  break;  case 'Mon':    $getHari = "Senin";  break;  case 'Tue':   $getHari = "Selasa";  break;  case 'Wed':   $getHari = "Rabu";  break;  case 'Thu':   $getHari = "Kamis";  break;  case 'Fri':   $getHari = "Jumat";  break;  case 'Sat':   $getHari = "Sabtu";  break;  default:   $getHari = "Salah";   break; }  return $getHari;}
$hari=conHari(date("D"));
$startTime = date("H:i:s");



$query = mysqli_query($db,"SELECT * FROM tbjadwal WHERE id_semester='$id_semester' and hari='$hari' and jam_awal >= '$startTime' or jam_akhir >= '$startTime' ORDER BY jam_awal ASC LIMIT 1");
$num_rows = mysqli_num_rows($query);
if ($num_rows > 0){
		$json = '{"value":1, "results": [';
		
		while ($row = mysqli_fetch_array($query)){
			if ($row['jam_awal'] >= $startTime) {
			$ket='Anda tidak terlambat';
			}else if ($row['jam_awal'] <= $startTime) {
				$ket='Anda Terlambat';
			}

			 $datamakul=mysqli_fetch_array(mysqli_query($db, "SELECT * from tbmatkul where id_matkul='$row[id_matkul]'"));
			 $datadosen=mysqli_fetch_array(mysqli_query($db, "SELECT * from tbdosen where nip='$row[nip]'"));
			 $dataruang=mysqli_fetch_array(mysqli_query($db, "SELECT * from tbruang where id_ruang='$row[id_ruang]'"));

			$char ='"';
			$json .= '{
				"id_jadwal": "'.str_replace($char,'`',strip_tags($row['id_jadwal'])).'",
				"nama_matkul": "'.str_replace($char,'`',strip_tags($datamakul['nama_matkul'])).'",
				"nama_dosen": "'.str_replace($char,'`',strip_tags($datadosen['nama_dosen'])).'",
				"nama_ruang": "'.str_replace($char,'`',strip_tags($dataruang['nama_ruang'])).'",
				"hari": "'.str_replace($char,'`',strip_tags($row['hari'])).'",
				"jam_awal": "'.str_replace($char,'`',strip_tags($row['jam_awal'])).'",
				"jam_akhir": "'.str_replace($char,'`',strip_tags($row['jam_akhir'])).'",
				"ket": "'.str_replace($char,'`',strip_tags($ket)).'"
			},';
		}

		$json = substr($json,0,strlen($json)-1);

		$json .= ']}';

	} else {
		$json = '{"value":0, "message": "Anda tidak memiliki jadwal."}';
	}
	echo $json;

	mysqli_close($db);

?>
