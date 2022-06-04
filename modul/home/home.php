<script src="assets/highcharts.js"></script>
<script src="assets/exporting.js"></script>
<script type="text/javascript">
    var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'Jumlah Mahasiswa Per Semester'
         },
         xAxis: {
            categories: ['Siswa']
         },
         yAxis: {
            title: {
               text: 'Jumlah Per Semester'
            }
         },
              series:             
            [
<?php        
$query = mysqli_query($con, "SELECT * from tbsemester") ;         
while($ambil = mysqli_fetch_array($query)){
    $namak=$ambil['nama_semester'];
    $id_tahun=$ambil['id_semester'];
    $query_jumlah = mysqli_query($con, "SELECT * from tbmahasiswa where id_semester='$id_tahun'") or die(mysqli_error());
      $jumlahx = mysqli_num_rows($query_jumlah);           
 
      ?>
      {
          name: '<?php echo $namak; ?>',
          data: [<?php echo $jumlahx; ?>]
      },
      <?php } ?>
]
});
}); 
</script>
<script type="text/javascript">
    var chart12; 
$(document).ready(function() {
      chart12 = new Highcharts.Chart({
         chart: {
            renderTo: 'containerprestasi',
            type: 'column'
         },   
         title: {
            text: 'Kehadiran Mahasiswa'
         },
         xAxis: {
            categories: ['Siswa']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
              series:             
            [
<?php        
// $query = mysqli_query($con, "SELECT * from tbabsen") ;         
// while($ambil = mysqli_fetch_array($query)){
    $statushadir='Hadir';
    $statusizin='Izin';
    $statussakit='Sakit';
    // $id_tahun=$ambil['id_tahun'];
    $query_jumlah = mysqli_query($con, "SELECT * from tbabsen where status='$statushadir'") or die(mysqli_error());
    $jumlahhadir = mysqli_num_rows($query_jumlah);   
    $query_jumlahizin = mysqli_query($con, "SELECT * from tbabsen where status='$statusizin'") or die(mysqli_error());
    $jumlahizin = mysqli_num_rows($query_jumlahizin);  
    $query_jumlahsakit = mysqli_query($con, "SELECT * from tbabsen where status='$statussakit'") or die(mysqli_error());
    $jumlahsakit = mysqli_num_rows($query_jumlahsakit);         
 
      ?>
      {
          name: '<?php echo $statushadir; ?>',
          data: [<?php echo $jumlahhadir; ?>]
      },{
          name: '<?php echo $statusizin; ?>',
          data: [<?php echo $jumlahizin; ?>]
      },{
          name: '<?php echo $statussakit; ?>',
          data: [<?php echo $jumlahsakit; ?>]
      },
      
]
});
}); 
</script>



                <div class="row">
                    <div class="col-lg-12">
                        <h1>Halaman Utama</h1>
                    </div>
                </div>
                  <hr />
                 <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">
                           
                          

                            <a class="quick-btn" href="media.php?modul=matakuliah">
                                <i class="icon-book icon-2x"></i>
                                <span>Matakuliah</span>
                                <span class="label label-success">
                                    <?php
                                    $sql   = mysqli_query($con, "SELECT * FROM tbmatkul"); 
                                    $row   = mysqli_num_rows($sql); 
                                    echo $row; 
                                    ?>
                                </span>
                            </a>
                            <a class="quick-btn" href="media.php?modul=ruang">
                                <i class="icon-building icon-2x"></i>
                                <span>Ruang</span>
                                <span class="label label-warning">+
                                <?php
                                    $sql   = mysqli_query($con, "SELECT * FROM tbruang"); 
                                    $row   = mysqli_num_rows($sql); 
                                    echo $row; 
                                    ?>
                                </span>
                            </a>
                            <a class="quick-btn" href="media.php?modul=peraturan">
                                <i class="icon-calendar-empty icon-2x"></i>
                                <span>Jadwal</span>
                                <span class="label label-info">+
                                <?php
                                    $sql   = mysqli_query($con, "SELECT * FROM tbjadwal"); 
                                    $row   = mysqli_num_rows($sql); 
                                    echo $row; 
                                    ?>
                                </span>
                            </a>
                            <a class="quick-btn" href="media.php?modul=dosen">
                                <i class="icon-group icon-2x"></i>
                                <span>Dosen</span>
                                <span class="label btn-metis-2">
                                   <?php
                                    $sql   = mysqli_query($con, "SELECT * FROM tbdosen"); 
                                    $row   = mysqli_num_rows($sql); 
                                    echo $row; 
                                    ?>
                                </span>
                            </a>     
                            <a class="quick-btn" href="media.php?modul=mahasiswa">
                                <i class="icon-user icon-2x"></i>
                                <span>Mahasiswa</span>
                                <span class="label btn-warning">
                                    <?php
                                    $sql   = mysqli_query($con, "SELECT * FROM tbmahasiswa"); 
                                    $row   = mysqli_num_rows($sql); 
                                    echo $row; 
                                    ?></span>
                            </a>                      
                            
                        </div>

                    </div>

                </div>
                <hr />
                 <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Grafik Mahasiswa
                            </div>                                                
                            <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                        </div>

                    </div>

                    
                     <div class="col-lg-6">
                         <div class="panel panel-default">
                            <div class="panel-heading">
                                Grafik Kehadiran
                            </div>                                                
                            <div id="containerprestasi" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                        </div>
                       
                    </div>
                </div>