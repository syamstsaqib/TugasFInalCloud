<?php
	include'ckoneksi.php';
	$nim     	= mysqli_real_escape_string($db,$_GET["username"]);
	$pass 	= mysqli_real_escape_string($db,$_GET["password"]);
	$result 	= mysqli_query($db,"SELECT * FROM tbmahasiswa where nim='$nim' and password='$pass'") or die(mysqli_error());
	$response["Hasil"] = array();
	if (mysqli_num_rows($result) > 0){
		$response["Hasil"] = array();
		$cari = mysqli_fetch_array($result);

		$kls = "SELECT * from tbsemester where id_semester = '$cari[id_semester]'";
		$hasilkls = mysqli_query($db,$kls);
		$datakls = mysqli_fetch_array($hasilkls);

		$hasil = array();
		$hasil["nim"] = $cari[0];
		$hasil["nama_mahasiswa"] 		 = $cari[1];
		$hasil["id_semester"] 		 = $datakls['id_semester'];
		$hasil["nama_semester"]  = $datakls['nama_semester'];
		$hasil["foto"]  = $cari[3];
		array_push($response["Hasil"],$hasil);
		$response["success"] = 1;
		echo json_encode($response);
	}else{
		$response["success"] = 0;
		echo json_encode($response);
		
	}
	?>