
<?php

	include "ckoneksi.php";

	$nim = $_POST['nim'];
	$passwordbaru = $_POST['passwordbaru'];
	
		$update = mysqli_query($db, "UPDATE tbmahasiswa SET 
			password='$passwordbaru'
		WHERE nim='$nim'") or die(mysqli_error($db));
		if ($update) {
			$arr['status'] = "berhasil";
		}

	echo json_encode($arr);
	
?>