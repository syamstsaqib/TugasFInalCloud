<?php
session_start();
include'../../config/koneksi.php';
include '../../config/excel_reader.php';
include '../../config/fungsi_tglindonesia.php';
//include '../../assets/excel_reader.php';
$adc = $_GET['adc'];

// function create_random($length) {
//     $data = 'abcdefghijklmnopqrstuvwxyz1234567890';
//     $string = '';
//     for ($i = 0; $i < $length; $i++) {
//         $pos = rand(0, strlen($data) - 1);
//         $string .= $data{$pos};
//     }
//     return $string;
// }


function conHari($hari){  switch($hari){  case 'Sun':   $getHari = "Minggu";  break;  case 'Mon':    $getHari = "Senin";  break;  case 'Tue':   $getHari = "Selasa";  break;  case 'Wed':   $getHari = "Rabu";  break;  case 'Thu':   $getHari = "Kamis";  break;  case 'Fri':   $getHari = "Jumat";  break;  case 'Sat':   $getHari = "Sabtu";  break;  default:   $getHari = "Salah";   break; }  return $getHari;}
$hari=conHari(date("D"));
$startTime = date("H:i:s");




if ($adc == 'vabsensi') {

    $output = array('data' => array());
    
    // $id_matkul    = ;
    error_reporting(0);
    if ($_POST['id_matkul']!="") {
         $sql = mysqli_query($con, "SELECT * FROM tbabsen where status='Izin' ORDER BY id_absen DESC");
    }else {
        $sql = mysqli_query($con, "SELECT * FROM tbabsen ORDER BY id_absen DESC");
     }

    

    $no = 1;
    
    while ($row = mysqli_fetch_array($sql)) {
            $sqljadwal = mysqli_query($con, "SELECT * FROM tbjadwal where id_jadwal='$row[id_jadwal]'");
            $rowjadwal = mysqli_fetch_array($sqljadwal);

            $sqlmk = mysqli_query($con, "SELECT * FROM tbmatkul where id_matkul='$rowjadwal[id_matkul]'");
            $rowmk = mysqli_fetch_array($sqlmk);
            $sqlsmt = mysqli_query($con, "SELECT * FROM tbsemester where id_semester='$rowjadwal[id_semester]'");
            $rowsmt = mysqli_fetch_array($sqlsmt);
            $sqldsn = mysqli_query($con, "SELECT * FROM tbdosen where nip='$rowjadwal[nip]'");
            $rowdsn = mysqli_fetch_array($sqldsn);
            $sqlruang = mysqli_query($con, "SELECT * FROM tbruang where id_ruang='$rowjadwal[id_ruang]'");
            $rowruang = mysqli_fetch_array($sqlruang);

            $sqlmh = mysqli_query($con, "SELECT * FROM tbmahasiswa where nim='$row[nim]'");
            $rowmh = mysqli_fetch_array($sqlmh);


            if (time($row['waktu_pulang']) >= $rowjadwal['jam_akhir']) {
                $ketp='Anda pulang cepat';
            }else if (time($row['waktu_pulang']) >= $rowjadwal['jam_akhir']) {
                $ketp='Anda Pulang Tepat waktu';
            }



            $nama_dosen="<p class='text-danger'>$rowdsn[nama_dosen]</p>";
            $nama_matkul="$rowmk[nama_matkul]";
            $nama_semester="$rowsmt[nama_semester]";
            $nama_ruang="$rowruang[nama_ruang]";

            $nomor="$no";
            $waktumasuk="$row[waktu_masuk]";
            $waktupulang="$row[waktu_pulang]";
            $nama_mahasiswa="$rowmh[nama_mahasiswa]";
            $status="$row[status]";
            $ket="$row[Ket]";

            if ($status=="Hadir") {
              $statusabsensi="<p class='text-info'>$status</p>";  
            }else if ($status=="Izin") {
              $statusabsensi="<p class='text-warning'>$status</p>";   
            }else {
              $statusabsensi="<p class='text-danger'>$status</p>";
            }
            if ($ket=="") {
                $keterangan="Kosong";
            }else {
                 $keterangan="<p class='text-info'>$ket</p>";
            }
            $fotomasuk='<a href="android/filefotomasuk/'.$row['file_masuk'].'"><img src="android/filefotomasuk/'.$row['file_masuk'].'" class="img-responsive" alt="Image" style="height:100px; width:100px;"></a>';
            if ($row['file_pulang']=="") {
                 $fotopulang='<a href="android/filefotopulang/noimage.png"><img src="android/filefotopulang/noimage.png" class="img-responsive" alt="Image" style="height:100px; width:100px;"></a>';
            }else{
                 $fotopulang='<a href="android/filefotopulang/'.$row['file_pulang'].'"><img src="android/filefotopulang/'.$row['file_pulang'].'" class="img-responsive" alt="Image" style="height:100px; width:100px;"></a>';
            }
           
            // <button type="button" class="btn btn-primary" data-toggle="modal" href="#edtmatakuliah" onclick="editData(' . $row['id_matkul'] . ')"> <i class="icon icon-pencil"></i></button>
            
            $opsi = '
                    <button type="button" class="btn btn-danger" data-toggle="modal" href="#konfirmasi_hapusmatakuliah" onclick="hapusData(' . $row['id_absen'] . ')"><i class="icon icon-trash"></i></button>';
        $output['data'][] = array(
            $nomor,
            $fotomasuk,
            $fotopulang,
            $nama_mahasiswa,
            $waktumasuk,
            $waktupulang,
            $statusabsensi,
            $keterangan,
            $ketp,
            $nama_dosen,
            $nama_matkul,
            $nama_semester,
            $nama_ruang,
            $opsi
        );
        $no++;
    }
    $con->close();
    echo json_encode($output);
} else if ($adc == 'smatakuliah') {
    $nama_matkul    = $_POST['nama_matkul'];
    $sks    = $_POST['sks'];
        $sql    = mysqli_query($con, "INSERT INTO `tbmatkul`(`nama_matkul`,`sks`) VALUES ('$nama_matkul','$sks')"); 
        if ($sql) {
            echo "1";
        } else {
            echo "0";
        }    
    
} else if ($adc == 'editmatakuliah') {
    $nama_matkul    = $_POST['nama_matkul'];
    $sks    = $_POST['sks'];
    $id     = $_POST['id'];

    $sql    = mysqli_query($con, "UPDATE tbmatkul SET nama_matkul='$nama_matkul',sks='$sks' WHERE id_matkul='$id'");
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($adc == 'habsen') {
    $id = $_POST['id'];
      $delete=mysqli_fetch_array(mysqli_query($con, "SELECT * from tbabsen where id_absen='$id'"));
    unlink("../../android/file/$delete[file]");
    $sql = mysqli_query($con, "DELETE FROM tbabsen WHERE id_absen='$id'") or die(mysqli_error());
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}elseif ($adc == 'edmatakuliah') {
    $id     = $_POST['id'];

    $sql    = "SELECT * FROM tbmatkul WHERE id_matkul ='$id'";
    $query  = $con->query($sql);
    $result = $query->fetch_assoc();
    //tutup koneksi
    $con->close();

    echo json_encode($result);
}
?>