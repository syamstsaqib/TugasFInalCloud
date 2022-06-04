<?php
 include("config/koneksi.php");
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
    <title>C.A.M.S | Login Admin </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/login.css" />
  <link rel="stylesheet" href="assets/plugins/magic/magic.css" />
  <script src="assets/plugins/jquery-2.0.3.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
  <script src="assets/js/login.js"></script>
  <!-- BEGIN PAGE VENDOR JS-->
  <link rel="stylesheet" type="text/css" href="assets/toastr/toastr.css">
  <script src="assets/toastr/vendortoastr.min.js"></script>
  <script src="assets/toastr/jstoastr.min.js"></script>
  <!-- END PAGE VENDOR JS-->
</head>
<body >
    <div class="container">
    <div class="text-center">
        <img src="assets/img/logo1.png" id="" alt="Logo" style="height: 150px;" />
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <div class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                    Masukkan Username dan Password
                </p>
                <input type="text" placeholder="Username" id="user" class="form-control" />
                <input type="password" placeholder="Password" id="pass" class="form-control" />
                
                <button class="btn text-muted text-center btn-danger" type="submit" id="bmasuk">Login</button>
            </div>
        </div>
    </div>
    <div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab"></a></li>
        </ul>
    </div>


</div>

  <script type="text/javascript">
    function pwarning(pesan) {
        toastr.warning(
            pesan,
            "Pesan",
            {progressBar:!0}
        )
    }
    function psukses(pesan) {
        toastr.success(
            pesan,
            "Pesan",
            {progressBar:!0}
        )
    }
    function pgagal(pesan) {
        toastr.error(
            pesan,
            "Information",
            {progressBar:!0}
        )
    }
    function pinfo(pesan) {
        toastr.info(
            pesan,
            "Pesan",
            {progressBar:!0}
        )
    }

    $("#bmasuk").click(function () {
        user = $("#user").val();
        pass = $("#pass").val();
        tahun_ajaran = $("#tahun_ajaran").val();
        if (user == "") {
            pwarning('Username Tidak Boleh Kosong');
            $("#user").focus();
        } else if (pass == "") {
            pwarning('Password Tidak Boleh Kosong');
            $("#pass").focus();
        }else if (tahun_ajaran == "") {
            pwarning('Tahun Tidak Boleh Kosong');
            $("#tahun_ajaran").focus();
        }
       else {
            data = "user=" + user + "&pass=" + pass;
            // psukses(data)
            $.ajax({
                type: 'POST',
                url: 'config/ceklogin.php',
                data: data,
                success: function (hasil) {
                    if (hasil == 1) {
                        document.location = 'media.php?modul=home';
                        psukses('Berhasil Login');
                    } else {
                        pgagal('Maaf Username Atau Password anda salah !!!')
                    }
                }
            });
        }
    })
  </script>
</body>
</html>
