<?php
session_start();
include'../../config/koneksi.php';
include '../../config/excel_reader.php';
include '../../config/fungsi_tglindonesia.php';
//include '../../assets/excel_reader.php';
$adc = $_GET['adc'];

function create_random($length) {
    $data = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $pos = rand(0, strlen($data) - 1);
        $string .= $data{$pos};
    }
    return $string;
}
$bulan = array (1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
if ($adc == 'vjadwal') {

    $output = array('data' => array());
    $sql = mysqli_query($con, "SELECT * FROM tbjadwal ORDER BY id_jadwal DESC");

    $no = 1;
    
    while ($row = mysqli_fetch_array($sql)) {
            $sqlmk = mysqli_query($con, "SELECT * FROM tbmatkul where id_matkul='$row[id_matkul]'");
            $rowmk = mysqli_fetch_array($sqlmk);
            $sqlsmt = mysqli_query($con, "SELECT * FROM tbsemester where id_semester='$row[id_semester]'");
            $rowsmt = mysqli_fetch_array($sqlsmt);
            $sqldsn = mysqli_query($con, "SELECT * FROM tbdosen where nip='$row[nip]'");
            $rowdsn = mysqli_fetch_array($sqldsn);
            $sqlruang = mysqli_query($con, "SELECT * FROM tbruang where id_ruang='$row[id_ruang]'");
            $rowruang = mysqli_fetch_array($sqlruang);

                     // $tanggal_indonesia = tgl_indonesia($row['tgl_lahir']);
            $nomor="$no";
            $nama_dosen="<p class='text-danger'>$rowdsn[nama_dosen]</p>";
            $nama_matkul="$rowmk[nama_matkul]";
            $nama_semester="$rowsmt[nama_semester]";
            $nama_ruang="$rowruang[nama_ruang]";
            $hari="$row[hari]";
            $jam_awal="$row[jam_awal]";
            $jam_akhir="$row[jam_akhir]";
           $opsi = '<button type="button" class="btn btn-primary" data-toggle="modal" href="#edtdatajadwal" onclick="editData(' . $row['id_jadwal'] . ')"> <i class="icon icon-pencil"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" href="#konfirmasi_hapusjadwal" onclick="hapusData(' . $row['id_jadwal'] . ')"><i class="icon icon-trash"></i></button>';
        $output['data'][] = array(
            $nomor,
            $nama_matkul,
            $nama_semester,
            $nama_dosen,
            $nama_ruang,
            $hari,
            $jam_awal,
            $jam_akhir,
            $opsi
        );
        $no++;
    }
    $con->close();
    echo json_encode($output);
} else if ($adc == 'sjadwal') {
    $id_matkul   = $_POST['id_matkul'];
    $id_semester   = $_POST['id_semester'];
    $nip   = $_POST['nip'];
    $id_ruang   = $_POST['id_ruang'];
    $hari   = $_POST['hari'];
    $jam_awal   = $_POST['jam_awal'];
    $jam_akhir   = $_POST['jam_akhir'];

        $waktu_awal=date_create($jam_awal);
        date_add($waktu_awal, date_interval_create_from_date_string('1 minutes'));
        $jamawal=date_format($waktu_awal,'H:i:s');

        $waktu_akhir=date_create($jam_akhir);
        date_add($waktu_akhir, date_interval_create_from_date_string('-1 minutes'));
        $jamakhir=date_format($waktu_akhir,'H:i:s');



         $sqlruangan =mysqli_query($con,"SELECT * FROM tbjadwal WHERE 
             id_ruang='$id_ruang' AND hari='$hari' AND
             (jam_awal BETWEEN '$jamawal' AND  '$jamakhir' OR
             jam_akhir BETWEEN '$jamawal' AND '$jamakhir') OR
             (jam_awal <='$jam_awal' AND jam_akhir >='$jam_akhir')");
         $cek_ruangan = mysqli_num_rows($sqlruangan);


        $sqlmatakuliah = mysqli_query($con,"SELECT * FROM tbjadwal 
            WHERE hari='$hari' AND id_matkul='$id_matkul' 
            AND nip='nip'");
        $cekmatakuliah = mysqli_num_rows($sqlmatakuliah);

         $sqldosen= mysqli_query($con,"SELECT * FROM tbjadwal 
            WHERE hari='$hari'
            AND nip='$nip'
            AND id_matkul='$id_matkul'
            AND (jam_awal BETWEEN '$jamawal' AND '$jamakhir' 
            OR  jam_akhir BETWEEN '$jamawal' AND '$jamakhir') 
            OR  (jam_awal <='$jam_awal' AND jam_akhir >='$jam_akhir')");
            $cek_dosen = mysqli_num_rows($sqldosen);

        if($cek_dosen > 0){
            echo "dosen sama Jadwal Crash";
        }else if ($cek_ruangan > 0) {
             echo "ruangan sama Jadwal Crash";
        }else if ($cekmatakuliah > 0) {
             echo "matakuliah sama Jadwal Crash";
        }else{
               
            $sqlsiswa = mysqli_query($con, "INSERT INTO tbjadwal SET
                        id_matkul                    = '$id_matkul',
                        id_semester                    = '$id_semester',
                        nip                  = '$nip',
                        id_ruang                    = '$id_ruang',
                        hari                    = '$hari',
                        jam_awal                    = '$jam_awal',
                        jam_akhir                   = '$jam_akhir'
                    ") or die(mysqli_error($con));
            if($sqlsiswa){
                echo "1";
            } else {
                 echo "0";
            }  
        }

    
} else if ($adc == 'editjadwal') {
    $id_matkul   = $_POST['id_matkul'];
    $id_semester   = $_POST['id_semester'];
    $nip   = $_POST['nip'];
    $id_ruang   = $_POST['id_ruang'];
    $hari   = $_POST['hari'];
    $jam_awal   = $_POST['jam_awal'];
    $jam_akhir   = $_POST['jam_akhir'];
    $id     = $_POST['id'];
    $sql    = mysqli_query($con, "UPDATE tbjadwal SET id_matkul='$id_matkul', id_semester='$id_semester',nip='$nip', id_ruang='$id_ruang', hari='$hari', jam_awal='$jam_awal',jam_akhir='$jam_akhir' WHERE id_jadwal='$id'");
    if ($sql) {
            echo "1";
    } else {
        echo "0";
    }
} elseif ($adc == 'hjadwal') {
    $id = $_POST['id'];
    $sql = mysqli_query($con, "DELETE FROM tbjadwal WHERE id_jadwal='$id'") or die(mysqli_error($con));
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}elseif ($adc == 'edjadwal') {
      $id     = $_POST['id'];

    $sql    = "SELECT * FROM tbjadwal WHERE id_jadwal ='$id'";
    $query  = $con->query($sql);
    $result = $query->fetch_assoc();
    //tutup koneksi
    $con->close();

    echo json_encode($result);
}elseif ($adc == 'hpsall') {
    $sql = mysqli_query($con, "DELETE FROM tb_petugas") or die(mysqli_error());
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}elseif ($adc == 'sxlsiswa') {
    $id_tahun   = $_SESSION['tahun_ajaran'];
    $edata = new Spreadsheet_Excel_Reader();
    $edata->setOutputEncoding('CP1251');
    if ($_FILES['fileexel']['tmp_name']) {
        $edata->read($_FILES['fileexel']['tmp_name']);
    }
    error_reporting(E_ALL ^ E_NOTICE);
    $arr = array();
    for ($i = 2; $i <= $edata->sheets[0]['numRows']; $i++) {
        for ($j = 1; $j <= $edata->sheets[0]['numCols']; $j++) {
            $arr[$i][$j] = $edata->sheets[0]['cells'][$i][$j];
        }
        $nis    = strtoupper($arr[$i][2]);
        $nama_siswa    = strtoupper($arr[$i][3]);
        $jenkel_siswa    = strtoupper($arr[$i][4]);
        $alamat_siswa   = strtoupper($arr[$i][5]);
        $hp_siswa = strtoupper($arr[$i][6]);
        $id_kelas    = strtoupper($arr[$i][7]);

        $nama_orangtuawali     = strtoupper($arr[$i][8]);
        $alamat_orangtuawali    = strtoupper($arr[$i][9]);
        $jenkel_orangtuawali    = strtoupper($arr[$i][10]);
        $hp_orangtuawali    = strtoupper($arr[$i][11]);
        
        $sql= mysqli_query($con, "INSERT INTO tb_siswa SET
                nis                    = '$nis',
                nama_siswa                    = '$nama_siswa',
                jenkel_siswa                  = '$jenkel_siswa',
                alamat_siswa                    = '$alamat_siswa',
                hp_siswa                    = '$hp_siswa',
                id_kelas                    = '$id_kelas',
                id_tahun                   = '$id_tahun'
            ") or die(mysqli_error($con));

        $sqlt = mysqli_query ($con,"SELECT id_siswa FROM tb_siswa ORDER BY id_siswa DESC ");
        $t = mysqli_fetch_array($sqlt);

        $id_siswa=$t['id_siswa'];
        $sqlorangtua = mysqli_query($con, "INSERT INTO tb_orangtuawali SET
                id_siswa                    = '$id_siswa',
                nama_orangtuawali                    = '$nama_orangtuawali',
                alamat_orangtuawali                  = '$alamat_orangtuawali',
                jenkel_orangtuawali                    = '$jenkel_orangtuawali',
                hp_orangtuawali                    = '$hp_orangtuawali'
            ") or die(mysqli_error($con));
    }
    if ($sql) {
      echo $edata->sheets[0]['numRows'] - 1;          
    } else {
        echo "0";
    }
}
?>