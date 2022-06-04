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
if ($adc == 'vsemester') {

    $output = array('data' => array());
    $sql = mysqli_query($con, "SELECT * FROM tbsemester ORDER BY id_semester");

    $no = 1;
    
    while ($row = mysqli_fetch_array($sql)) {
            $nomor="$no";
            $n="$row[nama_semester]";
            $opsi = '<button type="button" class="btn btn-primary" data-toggle="modal" href="#edtsemester" onclick="editData(' . $row['id_semester'] . ')"> <i class="icon icon-pencil"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" href="#konfirmasi_hapussemester" onclick="hapusData(' . $row['id_semester'] . ')"><i class="icon icon-trash"></i></button>';
        $output['data'][] = array(
            $nomor,
            $n,
            $opsi
        );
        $no++;
    }
    $con->close();
    echo json_encode($output);
} else if ($adc == 'ssemester') {
    $nama_semester    = $_POST['nama_semester'];
        $sql    = mysqli_query($con, "INSERT INTO `tbsemester`(`nama_semester`) VALUES ('$nama_semester')"); 
   
        if ($sql) {
            echo "1";
        } else {
            echo "0";
        }    
    
} else if ($adc == 'editsemester') {
    $nama_semester    = $_POST['nama_semester'];
    $id     = $_POST['id'];

    $sql    = mysqli_query($con, "UPDATE tbsemester SET nama_semester='$nama_semester' WHERE id_semester='$id'");
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($adc == 'hsemester') {
    $id = $_POST['id'];
    $sql = mysqli_query($con, "DELETE FROM tbsemester WHERE id_semester='$id'") or die(mysqli_error());
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}elseif ($adc == 'edsemester') {
    $id     = $_POST['id'];

    $sql    = "SELECT * FROM tbsemester WHERE id_semester ='$id'";
    $query  = $con->query($sql);
    $result = $query->fetch_assoc();
    //tutup koneksi
    $con->close();

    echo json_encode($result);
}elseif ($adc == 'hpsall') {
    $sql = mysqli_query($con, "DELETE FROM tb_penduduk") or die(mysqli_error());
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}elseif ($adc == 'sxlpenduduk') {
    $target = basename($_FILES['fileexel']['name']);
    move_uploaded_file($_FILES['fileexel']['tmp_name'], $target);

    chmod($_FILES['fileexel']['name'], 0777);

    $data = new Spreadsheet_Excel_Reader($_FILES['fileexel']['name'], false);
    //menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index = 0);
    for ($i = 2; $i <= $baris; $i++) {

        $barisreal = $baris-1;
        $k = $i-1;
        
        // menghitung persentase progress
        $percent = intval($k/$barisreal * 100);

        $nik        = strtoupper($data->val($i, 2));
        $nama       = strtoupper($data->val($i, 3));
        $tglxls     = strtoupper($data->val($i, 4));
        $jenis        = strtoupper($data->val($i, 5));
        $alamat         = strtoupper($data->val($i, 6));
        $status         = 1;
        $password =md5($nik);
        if ($nik == ""){
            echo "2";
        }
        else {
         $sql = mysqli_query($con, "INSERT INTO `tb_penduduk`(`nik`, `nama`, `tgl_lahir`, `jk`, `alamat`, `status`,`password`, `deskripsi`) VALUES ('$nik','$nama','$tglxls','$jenis','$alamat','$status','$password','$nik')"); 
        }    
        // echo $percent;
    }

    if ($sql) {
        echo $baris - 1;
        unlink($_FILES['fileexel']['name']);
    } else {
        echo "0";
    }
}
?>