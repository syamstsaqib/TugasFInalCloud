<?php
date_default_timezone_set("Asia/Jakarta");
include_once 'ckoneksi.php';
	$nim =  $_POST['nim'];

$cektanggal = date("Y-m-d");
$querybuttonaktif = mysqli_query($db,"SELECT * FROM tbabsen WHERE nim='$nim' and date(waktu_masuk)='$cektanggal'");
// $datasmt = mysqli_fetch_array($hasilsmt);
$num_rows = mysqli_num_rows($querybuttonaktif);

if ($num_rows > 0){
		$buttonaktif='Pulang';
		$json = '{"value":1, "results": [';

			$char ='"';
			$json .= '{
				"buttonaktif": "'.str_replace($char,'`',strip_tags($buttonaktif)).'"
			},';

		$json = substr($json,0,strlen($json)-1);

		$json .= ']}';

	} else {
		$buttonaktif='Masuk';
		$json = '{"value":1, "results": [';

			$char ='"';
			$json .= '{
				"buttonaktif": "'.str_replace($char,'`',strip_tags($buttonaktif)).'"
			},';

		$json = substr($json,0,strlen($json)-1);

		$json .= ']}';
	}
	echo $json;

	mysqli_close($db);

?>