<div class="row">
    <div class="col-lg-12">
        <h2> View Absensi</h2>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                            <!-- <div class="col-lg-2">
                                                <select class="form-control" id="id_matkul">
                                                    <option value="">Pilih Matakuliah</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbmatkul");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_matkul"]; ?>">
                                                            <?php echo $datasatuan["nama_matkul"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <select class="form-control" id="id_semester">
                                                    <option value="">Pilih Semester</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbsemester");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_semester"]; ?>">
                                                            <?php echo $datasatuan["nama_semester"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <select class="form-control" id="nip">
                                                    <option value="">Pilih Dosen</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbdosen");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["nip"]; ?>">
                                                            <?php echo $datasatuan["nama_dosen"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <select class="form-control" id="id_ruang">
                                                    <option value="">Pilih Ruangan</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbruang");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_ruang"]; ?>">
                                                            <?php echo $datasatuan["nama_ruang"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div> -->
                          <!--   <a href="#tambahdatamatakuliah" data-toggle="modal" class="btn btn-success">
                                   <i class="icon-plus icon-white"></i> Tambah
                            </a> -->
                           <!--  <div style="float:left;">Tampilkan
                            </div>
                            <br><br> -->
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-example" width="100%" cellspacing="0">
                                     <thead>
                                       <tr>  
                                       <th width="50">No</th>
                                       <th>Foto Masuk</th>
                                       <th>Foto Pulang</th>
                                       <th>Mahasiswa</th>
                                       <th>Waktu Masuk</th>
                                       <th>Waktu Pulang</th>
                                       <th>Status Absensi</th>
                                       <th>Ket M</th>
                                       <th>Ket P</th>
                                       <th>Dosen</th>
                                       <th>Matakuliah</th>
                                       <th>Semester</th>
                                       <th>Ruang</th>
                                       <th>Aksi</th>
                                       </tr>
                                       </thead>
                                 </table> 
                            </div>
                        </div>
                    </div>
                </div>
</div>



               
            <script type="text/javascript">
                function pwarning(pesan) {
                    toastr.warning(
                            pesan,
                            "Information",
                            {progressBar: !0}
                    )
                }
                function psukses(pesan) {
                    toastr.success(
                            pesan,
                            "Information",
                            {progressBar: !0}
                    )
                }
                function pgagal(pesan) {
                    toastr.error(
                            pesan,
                            "Information",
                            {progressBar: !0}
                    )
                }
                function pinfo(pesan) {
                    toastr.info(
                            pesan,
                            "Information",
                            {progressBar: !0}
                    )
                }
                
                var tampil;
                $(document).ready(function () {
                    // tampil.ajax.
                    tampil = $("#table-example").DataTable({
                        "ajax": {
                            url: "modul/absen/aksi.php?adc=vabsensi",
                            type: "post",
                        },
                        responsive: true,
                        "autoWidth": false,
                        "order": [],
                        "aLengthMenu": [
                            [50, 100, 200, -1],
                            [50, 100, 200, "All"]
                        ],
                        "iDisplayLength": 50,
                        "language": {
                            search: "Cari Semua Kategori",
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
                    
                    $('#id_matkul').change(function(){
                      if ($(this).val() !== '') {
                        $.ajax({
                          url: "modul/absen/aksi.php?adc=vabsensi",
                          type: "POST",
                          data: "id_matkul="+$(this).val(),
                          dataType: 'json',
                          success: function(msg){
                            DataTable.fnDestroy();

                            tampil.ajax.reload(msg, false);
                            // $('#table-example').DataTable(msg);
                          }
                        });
                      }
                      else {
                        $('#id_peraturan_pelanggaran').html('<option><i>Tidak ada</i></option>');
                      
                      }
                    });

                   

                });
            function hapusData(id) {
                     if (id) {
                        $('#id').val(id);
                        $.ajax({
                            url: 'modul/absen/aksi.php?adc=habsen',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                if (response == 1) {
                                          psukses('Data sudah di Hapus');
                                        tampil.ajax.reload(null, false);
                            } else {
                                pgagal('Failed')
                            }
                            }
                        });
                    } else {
                        alert("Error : Refresh the page again");
                    }
                }
                
            </script>