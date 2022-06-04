<?php
session_start();
	include'../../config/koneksi.php';
	include '../../config/excel_reader.php';
	include '../../config/fungsi_tglindonesia.php';
	require_once '../../config/fpdf/fpdf.php';	

$id_semester=$_POST['id_semesterpdf'];
$id_matkul=$_POST['id_matkulpdf'];   
$from   = $_POST['frompdf'];
$to   = $_POST['topdf']; 
   
$sqlmk = mysqli_query($con, "SELECT * FROM tbmatkul where id_matkul='$id_matkul'");
$rowmk = mysqli_fetch_array($sqlmk);
$sqlsmt = mysqli_query($con, "SELECT * FROM tbsemester where id_semester='$id_semester'");
$rowsmt = mysqli_fetch_array($sqlsmt);
$mk=$rowmk['nama_matkul'];
$st=$rowsmt['nama_semester'];
  

			$pdf = new FPDF();
			$pdf->AddPage();
			$image = '../../assets/img/logo22.png';
			// $pdf->Image('../../assets/img/favicon.png', 65, 0, 12, 12, "png");
			$pdf->Image($image,10,5,25); 
			$pdf->SetFont('Times','',15);
			$pdf->Cell(80);
			$pdf->Cell(30,10,'PIMPINAN PUSAT '.'',0,0,'C');
			$pdf->Ln(5);
			$pdf->Cell(80);
			$pdf->Cell(30,10,' '.'School',0,0,'C');

			$pdf->Ln(5);
			$pdf->Cell(80);
			$pdf->Cell(30,10,'(Absensi Online Mahasiswa) '.'',0,0,'C');
			
			//Times New Roman 15
			$pdf->SetFont('Times','',10);
			$pdf->Ln(5);
			$pdf->Cell(80);
			$pdf->Cell(30,10,'Alamat : Jl. S. ----- , 55012. Telp. (0274) 373122. Fax (0724) 385516',0,0,'C');

			//pindah baris
			$pdf->Ln(20);
			//buat garis horisontal
			$pdf->Line(16,34,200,34);

			//Jenis Surat
			$pdf->SetFont('Times','U',15);
			$pdf->Cell(0,0,'Laporan '.$st.' Matakuliah '.$mk,0,1,'C');
				
				
				//Nomor Surat
			$pdf->SetFont('Times','',13);
			$pdf->Cell(0,10,'Nomor: '.'____________',0,1,'C');

			$pdf->Cell(0, 8, 'Laporan Data dari tanggal '.tgl_indonesia($from).' sampai tanggal '.tgl_indonesia($to), 0, 1, 'L'); 

			$pdf->Cell(10, 7, 'No', 1, 0, 'L'); 
			$pdf->Cell(30, 7, 'Nim', 1, 0, 'L');
			$pdf->Cell(70, 7, 'Nama Mahasiswa', 1, 0, 'L');
			$pdf->Cell(25, 7, 'Hadir', 1, 0, 'L'); 
			$pdf->Cell(25, 7, 'Sakit', 1, 0, 'L'); 
			$pdf->Cell(25, 7, 'Izin', 1, 0, 'L'); 
			$pdf->Ln();
			$no=1;
                                          
            $total_penjualan=0;
			$tampilmahasiswa = mysqli_query($con, "SELECT * FROM tbmahasiswa where id_semester='$id_semester'") or die(mysqli_error($koneksi));
			$tampilid_jadwal = mysqli_query($con, "SELECT * FROM tbjadwal where id_semester='$id_semester' and id_matkul='$id_matkul'") or die(mysqli_error($koneksi));
			$rowtampilid_jadwal = mysqli_fetch_array($tampilid_jadwal);
            $id_jadwal=$rowtampilid_jadwal['id_jadwal'];
            while($data = mysqli_fetch_array($tampilmahasiswa)){
            	 $tampilHadir = mysqli_query($con, "SELECT * FROM tbabsen where nim='$data[nim]' and id_jadwal='$id_jadwal' and status='Hadir' AND date(waktu) BETWEEN '$from' AND '$to'") or die(mysqli_error($koneksi));
                 $jmHadir = mysqli_num_rows($tampilHadir);
                 $tampilIzin = mysqli_query($con, "SELECT * FROM tbabsen where nim='$data[nim]' and id_jadwal='$id_jadwal' and status='Izin' AND date(waktu) BETWEEN '$from' AND '$to'") or die(mysqli_error($koneksi));
                 $jmIzin= mysqli_num_rows($tampilIzin);
                 $tampilSakit = mysqli_query($con, "SELECT * FROM tbabsen where nim='$data[nim]' and id_jadwal='$id_jadwal' and status='Sakit' AND date(waktu) BETWEEN '$from' AND '$to'") or die(mysqli_error($koneksi));
                 $jmSakit= mysqli_num_rows($tampilSakit);

	         // $tampil = mysqli_query($con, "SELECT * FROM tb_nilai a, tb_warga b where a.nik=b.nik") or die(mysqli_error($koneksi));
	         // while($data = mysqli_fetch_array($tampil)){
				$pdf->Cell(10, 7, $no, 1, 0, 'L'); 
				$pdf->Cell(30, 7, $data['nim'], 1, 0, 'L');
				$pdf->Cell(70, 7, $data['nama_mahasiswa'], 1, 0, 'L');
				$pdf->Cell(25, 7, $jmHadir, 1, 0, 'L');
				$pdf->Cell(25, 7, $jmSakit, 1, 0, 'L');
				$pdf->Cell(25, 7, $jmIzin, 1, 0, 'L');
				$pdf->Ln();
				$no++;
			}



			$waktu_input        = date('Y-m-d');
			$pdf->Ln(30);
			$pdf->Cell(134);
			$pdf->Cell(0,5,'School'.','.date('j/m/Y',strtotime($waktu_input)),0,0,'C');
			
			$pdf->Ln(8);
			$pdf->Cell(134);
			$pdf->Cell(0,5,'Pimpinan ',0,0,'C');
			
			// $pdf->Ln(5);
			// $pdf->Cell(134);
			// $pdf->Cell(0,5,'Kec. '.'$kecamatan',0,0,'C');
			
			$pdf->SetFont('Times','BU',11);
			$pdf->Ln(30);
			$pdf->Cell(134);
			$pdf->Cell(0,5,'Suharto',0,0,'C');
			
			$pdf->SetFont('Times','',11);
			$pdf->Ln(5);
			$pdf->Cell(134);
			$pdf->Cell(0,5,'NIP. '.'28990821982',0,0,'C');
		$pdf->Output();
		?>
