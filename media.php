
  <?php
session_start();
if(!empty($_SESSION['username']) and !empty($_SESSION['password'])){
  include("config/koneksi.php");
  define("INDEX",true);
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8" />
    <title>C.A.M.S </title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link href="assets/plugins/flot/examples/examples.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/timeline/timeline.css" />
    <link rel="stylesheet" type="text/css" href="assets/datatables/media/css/dataTables.bootstrap4.css">

    <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot/jquery.flot.time.js"></script>
    <script  src="assets/plugins/flot/jquery.flot.stack.js"></script>
    <!--  -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/datepicker/css/datepicker.css"/>
    <script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="assets/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="assets/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="assets/datatables-fixedcolumns/js/dataTables.fixedColumns.js"></script>
    <script src="assets/datatables-responsive/js/dataTables.responsive.js"></script>

    <!-- BEGIN PAGE VENDOR JS-->
    <link rel="stylesheet" type="text/css" href="assets/toastr/toastr.css">
    <script src="assets/toastr/vendortoastr.min.js"></script>
    <script src="assets/toastr/jstoastr.min.js"></script>
    <!-- END PAGE VENDOR JS-->
</head>
<body class="padTop53 " >
    <div id="wrap" >
        <div id="top">
            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">
                    <a href="media.php?modul=home" class="navbar-brand">
                    <!-- <img src="assets/img/logo1.png" alt="" /> -->
                    <h7>C.A.M.S</h7> 
                    </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#editprofile" data-toggle="modal"><i class="icon-user"></i> Ubah Password  </a>
                            </li>
                            <li class="divider"></li>
                            <li><a type="button" data-toggle="modal" href="#konfirmasi_keluar"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>
            </nav>
        </div>
        <!-- END HEADER SECTION -->
        <!-- konfirmasi --> 
        <div class="modal fade" id="konfirmasi_keluar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                    <b>Anda yakin ingin Keluar ?</b><br><br>
                    <a href="media.php?modul=logout" class="btn btn-danger btn-ok" id="bhapus">Iya</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
                    </div>
                </div>
            </div>
         </div>                           
        <!-- tutupkonfirmasi -->
        <!-- MENU  -->
       <div id="left" ><?php include("menu.php");?></div>
        <!--END MENU  -->
        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height:700px;">
                <!-- ubahpassword -->
                <div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h5 class="modal-title">Ubah Password</h5>
                                
                            </div>
                                <input type="text" id="profileid" name="id" value="<?php echo $_SESSION['id_user']; ?>" hidden="">
                            
                            <div class="modal-body">
                                 <div class="form-group">
                                    <label class="form-label" for="validation-username">Username</label>
                                    <input type="text" id="profileusername" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="validation-username">Password</label>
                                    <input type="password" id="profilepassword" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="validation-username">Ulangi Password</label>
                                    <input type="password" id="profileupassword" name="upassword" class="form-control">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="beditprofile">Ubah Profile</button>
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tutup -->
              <?php
                if ($_GET['modul'] == "home") {
                    include'modul/home/home.php';
                }else if ($_GET['modul'] == "jenis_pelanggaran") {
                    include'modul/jenis_pelanggaran/jenis_pelanggaran.php';
                }else if ($_GET['modul'] == "peraturan_pelanggaran") {
                    include'modul/peraturan_pelanggaran/peraturan_pelanggaran.php';
                }else if ($_GET['modul'] == "semester") {
                    include'modul/semester/semester.php';
                }else if ($_GET['modul'] == "ruang") {
                    include'modul/ruang/ruang.php';
                }else if ($_GET['modul'] == "matakuliah") {
                    include'modul/matakuliah/matakuliah.php';
                }else if ($_GET['modul'] == "dosen") {
                    include'modul/dosen/dosen.php';
                }else if ($_GET['modul'] == "mahasiswa") {
                    include'modul/mahasiswa/mahasiswa.php';
                }else if ($_GET['modul'] == "jadwal") {
                    include'modul/jadwal/jadwal.php';
                }else if ($_GET['modul'] == "absensi") {
                    include'modul/absen/absensi.php';
                }else if ($_GET['modul'] == "laporan") {
                    include'modul/laporan/laporan.php';
                }else if ($_GET['modul'] == "logout") {
                    include'modul/keluar/keluar.php';
                }
                ?>
            </div>
        </div>
        <!--END PAGE CONTENT -->
    </div>
    <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  C.A.M.S &nbsp;2021 &nbsp;</p>
    </div>
    <!--END FOOTER -->

 <script>
      function pwarning(pesan) {
            toastr.warning(
                pesan,
                "Information", {
                    progressBar: !0
                }
            )
        }

        function psukses(pesan) {
            toastr.success(
                pesan,
                "Information", {
                    progressBar: !0
                }
            )
        }

        function pgagal(pesan) {
            toastr.error(
                pesan,
                "Information", {
                    progressBar: !0
                }
            )
        }

        function pinfo(pesan) {
            toastr.info(
                pesan,
                "Information", {
                    progressBar: !0
                }
            )
        }
        $(document).ready(function() {

            $("#beditprofile").click(function() {
                id = $("#profileid").val();
                eusername = $("#profileusername").val();
                epassword = $("#profilepassword").val();
                eupassword = $("#profileupassword").val();
                if (eusername == "") {
                    pwarning('password Tidak Boleh Kosong');
                    $("#profileusername").focus();
                } else {
                    data = "eusername=" + eusername + "&epassword=" + epassword + "&eupassword=" + eupassword + "&id=" + id;
                    $.ajax({
                        type: 'POST',
                        url: 'modul/user/aksi.php?adc=editprofile',
                        data: data,
                        success: function(hasil) {
                            if (hasil == 2) {
                                pgagal('Ulangi Password tidak sama');
                            } else if (hasil == 3) {
                                document.location = 'media.php?modul=logout';
                            } else {
                                pgagal('Failed');
                            }
                        }
                    });
                }
            });

        });
</script>




</body>

    <!-- END BODY -->
</html>
<?php
  }else{
echo"Dilarang membuka halaman ini!";
echo"<meta http-equiv='refresh' content='1; url=index.php'>";
  }
?>


