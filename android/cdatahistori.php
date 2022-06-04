<?php 
	include_once "ckoneksi.php";
	$nim =  $_POST['nim'];

	$query = mysqli_query($db, "SELECT * FROM tbabsen where nim='$nim'");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows > 0){
		$json = '{"value":1, "results": [';

		while ($row = mysqli_fetch_array($query)){
			 $datajadwal=mysqli_fetch_array(mysqli_query($db, "SELECT * from tbjadwal where id_jadwal='$row[id_jadwal]'"));
			 $datamakul=mysqli_fetch_array(mysqli_query($db, "SELECT * from tbmatkul where id_matkul='$datajadwal[id_matkul]'"));
			 if ($row['Ket']=="") {
			 	$ket="Kosong";
			 }else{
			 	$ket=$row['Ket'];
			 }
			
			$char ='"';

			$json .= '{
				"id_absensi": "'.str_replace($char,'`',strip_tags($row['id_absen'])).'",
				"id_jadwal": "'.str_replace($char,'`',strip_tags($datamakul['nama_matkul'])).'",
				"waktu": "'.str_replace($char,'`',strip_tags($row['waktu'])).'",
				"status": "'.str_replace($char,'`',strip_tags($row['status'])).'",
				"ket": "'.str_replace($char,'`',strip_tags($ket)).'",
				"file": "'.str_replace($char,'`',strip_tags($row['file'])).'"
			},';
		}

		$json = substr($json,0,strlen($json)-1);

		$json .= ']}';

	} else {
		$json = '{"value":0, "message": "Data tidak Ada."}';
	}

	echo $json;

	mysqli_close($db);
?>