 <?php
session_start();
include'../../config/koneksi.php';
include '../../config/excel_reader.php';
include '../../config/fungsi_tglindonesia.php';

$id_semester=$_POST['id_semester'];
$id_matkul=$_POST['id_matkul'];   
$from   = $_POST['from'];
$to   = $_POST['to']; 
?>
<div class='alert alert-info'>
Data dari tanggal <b><?php echo tgl_indonesia($from); ?></b> sampai tanggal <b><?php echo tgl_indonesia($to); ?></b>
</div>
<br />
<div class="row">
    <div class="col-lg-12">
        <h2> Data Laporan</h2>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                  <p>
                                    <?php
                                    $from   = date('Y-m-d', strtotime($from));
                                    $to   = date('Y-m-d', strtotime($to));
                                    ?>
                                    <form action="modul/laporan/printpdf.php" method="POST" role="form" id="FormLaporanpdf">
                                      <input type="hidden" name="id_semesterpdf" id="id_semesterpdf" class="form-control" value="<?php echo $id_semester; ?>">
                                      <input type="hidden" name="id_matkulpdf" id="id_matkulpdf" class="form-control" value="<?php echo $id_matkul; ?>">
                                      <input type="hidden" name="frompdf" id="frompdf" class="form-control" value="<?php echo $from; ?>">
                                      <input type="hidden" name="topdf" id="topdf" class="form-control" value="<?php echo $to; ?>">
                                      <button type="submit" class='btn btn-default'><img src="assets/img/pdf.png"> Export ke PDF</button>
                                    </form>
                                    <form action="modul/laporan/printexcel.php" method="POST" role="form" id="FormLaporanxls" >
                                      <input type="hidden" name="id_semesterxls" id="id_semesterxls" class="form-control" value="<?php echo $id_semester; ?>">
                                      <input type="hidden" name="id_matkulxls" id="id_matkulxls" class="form-control" value="<?php echo $id_matkul; ?>">
                                      <input type="hidden" name="fromxls" id="fromxls" class="form-control" value="<?php echo $from; ?>">
                                      <input type="hidden" name="toxls" id="toxls" class="form-control" value="<?php echo $to; ?>">
                                      <button type="submit" class='btn btn-default' target='blank'><img src="assets/img/xls.png"> Export ke xls</button>
                                    </form>
                                  </p>
                            
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbbpnnormalisasi" width="100%" cellspacing="0">
                                     <thead>
                                       <tr>  
                                          <th>No</th>
                                          <th>Nim</th>
                                          <th>Nama Mahasiswa</th>
                                          <th>Hadir</th>
                                          <th>Sakit</th>
                                          <th>Izin</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                        <?php
                                              $no=1;
                                          
                                              $total_penjualan=0;

                                               $tampilmahasiswa = mysqli_query($con, "SELECT * FROM tbmahasiswa where id_semester='$id_semester'") or die(mysqli_error($koneksi));

                                                $tampilid_jadwal = mysqli_query($con, "SELECT * FROM tbjadwal where id_semester='$id_semester' and id_matkul='$id_matkul'") or die(mysqli_error($koneksi));
                                                $rowtampilid_jadwal = mysqli_fetch_array($tampilid_jadwal);
                                                $id_jadwal=$rowtampilid_jadwal['id_jadwal'];
                                                // echo $id_jadwal;

                                              while($data = mysqli_fetch_array($tampilmahasiswa)){

                                               $tampilHadir = mysqli_query($con, "SELECT * FROM tbabsen where nim='$data[nim]' and id_jadwal='$id_jadwal' and status='Hadir' AND date(waktu) BETWEEN '$from' AND '$to'") or die(mysqli_error($koneksi));
                                                $jmHadir = mysqli_num_rows($tampilHadir);

                                                $tampilIzin = mysqli_query($con, "SELECT * FROM tbabsen where nim='$data[nim]' and id_jadwal='$id_jadwal' and status='Izin' AND date(waktu) BETWEEN '$from' AND '$to'") or die(mysqli_error($koneksi));
                                                $jmIzin= mysqli_num_rows($tampilIzin);

                                                $tampilSakit = mysqli_query($con, "SELECT * FROM tbabsen where nim='$data[nim]' and id_jadwal='$id_jadwal' and status='Sakit' AND date(waktu) BETWEEN '$from' AND '$to'") or die(mysqli_error($koneksi));
                                                $jmSakit= mysqli_num_rows($tampilSakit);


                                          ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td><?php echo $data['nim']; ?> </td>
                                              <td><?php echo $data['nama_mahasiswa']; ?> </td>
                                              <td><?php echo $jmHadir; ?></td>
                                              <td> <?php echo $jmSakit; ?></td>
                                              <td><?php echo $jmIzin; ?></td>
                                          </tr>
                                           <?php 
                                                  $no++;
                                              } 
                                              
                                          ?>
                                         
                                         
                                      </tbody>
                                 </table>
                                 <!--  -->
                                 <div id='resultxls'></div>
                                 <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
</div>
<script src="assets/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables/media/js/dataTables.bootstrap4.js"></script>
<script src="assets/datatables-fixedcolumns/js/dataTables.fixedColumns.js"></script>
<script src="assets/datatables-responsive/js/dataTables.responsive.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#tbbpnnormalisasi').DataTable({
                        responsive: true,
                        "autoWidth": false,
                        "order": [],
                        "aLengthMenu": [
                            [50, 100, 200, -1],
                            [50, 100, 200, "All"]
                        ],
                        "iDisplayLength": 50,
                        "language": {
                            search: "Cari",
                            sProcessing:   "Sedang memproses...",
                            sLengthMenu:   "Tampilkan _MENU_ Data",
                            sZeroRecords:  "Tidak ditemukan data yang sesuai",
                            sInfo:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            sInfoEmpty:    "Menampilkan 0 sampai 0 dari 0 data",
                            sInfoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                            "paginate": {
                              "previous": 'Sebelum <i class="fa fa-angle-left"></i> ',
                              "next": '<i class="fa fa-angle-right"></i> Selanjutnya'
                            }
                        }
                    });
    // $(document).on('submit', '#FormLaporanxls', function(event){
    //                     event.preventDefault();
    //                         $.ajax({
    //                             method: 'POST',
    //                             url: 'modul/laporan/printexcel.php',
    //                             data:new FormData(this),
    //                             contentType:false,
    //                             processData:false,
    //                             success: function (hasil) {
    //                                 $('#resultxls').html(hasil);
    //                             }
    //                         });
    //                 });

  });
</script>