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
if ($adc == 'vmatakuliah') {

    $output = array('data' => array());
    $sql = mysqli_query($con, "SELECT * FROM tbmatkul");

    $no = 1;
    
    while ($row = mysqli_fetch_array($sql)) {
            $nomor="$no";
            $nama_matkul="$row[nama_matkul]";
            $sks="$row[sks]";
            $opsi = '<button type="button" class="btn btn-primary" data-toggle="modal" href="#edtmatakuliah" onclick="editData(' . $row['id_matkul'] . ')"> <i class="icon icon-pencil"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" href="#konfirmasi_hapusmatakuliah" onclick="hapusData(' . $row['id_matkul'] . ')"><i class="icon icon-trash"></i></button>';
        $output['data'][] = array(
            $nomor,
            $nama_matkul,
            $sks,
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
} elseif ($adc == 'hmatakuliah') {
    $id = $_POST['id'];
    $sql = mysqli_query($con, "DELETE FROM tbmatkul WHERE id_matkul='$id'") or die(mysqli_error());
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