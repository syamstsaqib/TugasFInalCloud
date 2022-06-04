 <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/logo1.png" style="width: 90px;" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"> <?php echo $_SESSION['username']; ?></h5>
                    <ul class="list-unstyled user-info">
                        <li>C.A.M.S</li>
                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">

                
                <li class="panel <?php if ($_GET['modul'] == "home") {echo 'active';}?>">
                    <a href="media.php?modul=home" >
                        <i class="icon-home"></i> Halaman Utama
	   
                       
                    </a>                   
                </li>



                <li class="panel <?php if ($_GET['modul'] == "semester" or $_GET['modul'] == "ruang" or $_GET['modul'] == "matakuliah" or $_GET['modul'] == "dosen" or $_GET['modul'] == "mahasiswa") {echo 'active';}?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-desktop"> </i> Data Setting     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="<?php if ($_GET['modul'] == "semester" or $_GET['modul'] == "ruang" or $_GET['modul'] == "matakuliah" or $_GET['modul'] == "dosen" or $_GET['modul'] == "mahasiswa") {echo 'in';}else{echo 'collapse';}?>" id="component-nav">
                       
                        <li class=""><a href="media.php?modul=semester"><i class="icon-angle-right"></i> Semester/Prodi </a></li>
                        <li class=""><a href="media.php?modul=ruang"><i class="icon-angle-right"></i> Ruangan </a></li>
                        <li class=""><a href="media.php?modul=matakuliah"><i class="icon-angle-right"></i> Mata Kuliah </a></li>
                        <li class=""><a href="media.php?modul=dosen"><i class="icon-angle-right"></i> Dosen</a></li>
                        <li class=""><a href="media.php?modul=mahasiswa"><i class="icon-angle-right"></i> Mahasiswa</a></li>
                       <!--  <li class=""><a href="media.php?modul=peraturan_prestasi"><i class="icon-angle-right"></i> Peraturan Prestasi</a></li> -->
                    </ul>
                </li>
               
                <li class="panel <?php if ($_GET['modul'] == "jadwal" or $_GET['modul'] == "absensi") {echo 'active';}?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#chart-nav">
                        <i class="icon-bar-chart"></i> Data Proses
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="<?php if ($_GET['modul'] == "jadwal" or $_GET['modul'] == "absensi") {echo 'in';}else{echo 'collapse';}?>" id="chart-nav">
                        <li><a href="media.php?modul=jadwal"><i class="icon-angle-right"></i> Jadwal Kuliah</a></li>
                        <li><a href="media.php?modul=absensi"><i class="icon-angle-right"></i> Melihat Absensi</a></li>
                    </ul>
                </li>
                <li class="panel <?php if ($_GET['modul'] == "laporan") {echo 'active';}?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#laporan">
                        <i class="icon-paste"></i> Laporan
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="<?php if ($_GET['modul'] == "laporan") {echo 'in';}else{echo 'collapse';}?>" id="laporan">
                        <li><a href="media.php?modul=laporan"><i class="icon-angle-right"></i>Laporan</a></li>
                    </ul>
                </li>
                

            </ul>