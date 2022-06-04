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
if ($adc == 'vdosen') {

    $output = array('data' => array());
    $sql = mysqli_query($con, "SELECT * FROM tbdosen");

    $no = 1;
    
    while ($row = mysqli_fetch_array($sql)) {
            $nomor="$no";
            $nip="$row[nip]";
            $nama_dosen="$row[nama_dosen]";
            $opsi = '<button type="button" class="btn btn-primary" data-toggle="modal" href="#edtdosen" onclick="editData(' . $row['nip'] . ')"> <i class="icon icon-pencil"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" href="#konfirmasi_hapusdosen" onclick="hapusData(' . $row['nip'] . ')"><i class="icon icon-trash"></i></button>';
        $output['data'][] = array(
            $nomor,
            $nip,
            $nama_dosen,
            $opsi
        );
        $no++;
    }
    $con->close();
    echo json_encode($output);
} else if ($adc == 'sdosen') {
    $nip    = $_POST['nip'];
    $nama_dosen    = $_POST['nama_dosen'];
        $sql    = mysqli_query($con, "INSERT INTO `tbdosen`(`nip`,`nama_dosen`) VALUES ('$nip','$nama_dosen')"); 
        if ($sql) {
            echo "1";
        } else {
            echo "0";
        }    
    
} else if ($adc == 'editdosen') {
    $nama_dosen    = $_POST['nama_dosen'];
    $id     = $_POST['id'];

    $sql    = mysqli_query($con, "UPDATE tbdosen SET nama_dosen='$nama_dosen' WHERE nip='$id'");
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
} elseif ($adc == 'hdosen') {
    $id = $_POST['id'];
    $sql = mysqli_query($con, "DELETE FROM tbdosen WHERE nip='$id'") or die(mysqli_error());
    if ($sql) {
        echo "1";
    } else {
        echo "0";
    }
}elseif ($adc == 'eddosen') {
    $id     = $_POST['id'];

    $sql    = "SELECT * FROM tbdosen WHERE nip='$id'";
    $query  = $con->query($sql);
    $result = $query->fetch_assoc();
    //tutup koneksi
    $con->close();

    echo json_encode($result);
}
?>