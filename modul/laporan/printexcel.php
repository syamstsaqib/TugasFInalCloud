 <?php
session_start();
include'../../config/koneksi.php';
include '../../config/excel_reader.php';
include '../../config/fungsi_tglindonesia.php';

$id_semester=$_POST['id_semesterxls'];
$id_matkul=$_POST['id_matkulxls'];   
$from   = $_POST['fromxls'];
$to   = $_POST['toxls']; 

$sqlmk = mysqli_query($con, "SELECT * FROM tbmatkul where id_matkul='$id_matkul'");
$rowmk = mysqli_fetch_array($sqlmk);
$sqlsmt = mysqli_query($con, "SELECT * FROM tbsemester where id_semester='$id_semester'");
$rowsmt = mysqli_fetch_array($sqlsmt);
$mk=$rowmk['nama_matkul'];
$st=$rowsmt['nama_semester'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan $mk Matakuliah $st.xls");
?>

        <table class="table table-bordered" id="tbbpnnormalisasi" width="100%" cellspacing="0" border="1">
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
                                                echo $id_jadwal;

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