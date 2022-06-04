<?php

// panggil fungsi validasi xss dan injection ganti db = unbk menjadi database yang di buat
require_once('fungsi_validasi.php');

$host	= "localhost";
$user	= "root";
$pass	= "";
$db		= "sensasiq";

//Menggunakan objek mysqli untuk membuat koneksi dan menyimpanya dalam variabel $mysqli	
$con = new mysqli($host, $user, $pass, $db);

// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new validasi;

//Membuat variabel yang menyimpan url website dan folder website, ganti /unbk dengan folder yang ada di htdoc
// $url_website = "http://localhost/unbk";
// $folder_website = "/unbk";

//Menentukan timezone 
date_default_timezone_set('Asia/Jakarta'); 
// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
// mengecek koneksi
// if (!$con) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
// echo "Koneksi berhasil";
// mysqli_close($conn);
?>
