<?php
date_default_timezone_set("Asia/Jakarta");
include("koneksi.php");
# Fungsi untuk membuat kode automatis
function buatKode($tabel, $inisial){
	$struktur	= mysqli_query($koneksi,"SELECT * FROM $tabel");
	$field		= mysqli_field_name($struktur,0);
	$panjang	= mysqli_field_len($struktur,0);

 	$qry	= mysqli_query($koneksi,"SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysqli_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

// Konvesi dd-mm-yyyy -> yyyy-mm-dd
function tgl_ind_to_eng() {
	$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
	return $tgl_eng;
}


// Konvesi yyyy-mm-dd -> dd-mm-yyyy
function tgl_eng_to_ind($tgl) {
	$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
	return $tgl_ind;
}
?>