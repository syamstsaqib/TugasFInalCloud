<?php

session_start();
include'../../config/koneksi.php';

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
if ($adc == 'editprofile') {
    if ($_POST['epassword'] == "" and $_POST['eupassword'] == "") {
                $username   = $_POST['eusername'];
                $id     = $_POST['id'];
                $sql    = mysqli_query($con, "UPDATE tbuser SET username='$username' WHERE id_user='$id'");
                if ($sql) {
                    echo "3";
                } else {
                    echo "0";
                }
      
    }else {
        if($_POST['epassword'] != $_POST['eupassword']){
             echo "2";
        }else{
                $username   = $_POST['eusername'];
                $upassword   = $_POST['eupassword'];
                $id     = $_POST['id'];
                $passwordm = $_POST['epassword'];
             $sql    = mysqli_query($con, "UPDATE tbuser SET username='$username', password='$passwordm' WHERE id_user='$id'");
                if ($sql) {
                    echo "3";
                } else {
                    echo "0";
                }
        }

    }
}