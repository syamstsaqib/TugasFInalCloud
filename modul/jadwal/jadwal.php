<div class="row">
    <div class="col-lg-12">
        <h2> Jadwal</h2>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#tambahdatajadwal" data-toggle="modal" class="btn btn-success">
                                   <i class="icon-plus icon-white"></i> Tambah
                            </a>
                           <!--  <a href="download/siswa.xls" class="btn btn-default">
                                   <i class="icon-download"></i> Download Format .xls
                            </a>
                            <a href="#uploadexceldatasiswa" data-toggle="modal" class="btn btn-warning">
                                   <i class="icon-plus icon-white"></i> Upload
                            </a> -->
                            <div style="float:right;">Data Jadwal
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-example" width="100%" cellspacing="0">
                                       <thead>
                                           <tr>  
                                           <th width="50">No</th>
                                           <th>Matakuliah</th>
                                           <th>Semester</th>
                                           <th>Dosen</th>
                                           <th>Ruang</th>
                                           <th>Hari</th>
                                           <th>Jam Awal</th>
                                           <th>Jam Akhir</th>
                                           <th width="100">Aksi</th>
                                           </tr>
                                       </thead>
                                 </table> 
                            </div>
                        </div>
                    </div>
                </div>
</div>

            <!-- Tambah data -->
                <div class="modal fade" id="tambahdatajadwal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Tambah Jadwal</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Matakuliah</label>
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
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Semester</label>
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
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Dosen</label>
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
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Ruangan</label>
                                                <select class="form-control" id="id_ruang">
                                                    <option value="">Pilih Ruangan</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbruang");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_ruang"]; ?>">
                                                            <?php echo $datasatuan["nama_ruang"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                             
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Hari</label>
                                                <select class="form-control" id="hari">
                                                    <option value="">Pilih Kelas</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Minggu">Minggu</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                
                                                <hr><p class="text-info">Waktu</p><hr>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Jam Awal</label>
                                                <input type="time" id="jam_awal" name="jam_awal"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Jam Akhir</label>
                                                <input type="time" id="jam_akhir" name="jam_akhir"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="bsavejadwal">Simpan</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tutup -->
                     <!-- Edit Tambah -->
                    <div class="modal fade" id="edtdatajadwal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Edit Siswa</h5>
                                </div> 
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <input type="hidden" id="id" name="id">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Matakuliah</label>
                                                <select class="form-control" id="eid_matkul">
                                                    <option value="">Pilih Matakuliah</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbmatkul");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_matkul"]; ?>">
                                                            <?php echo $datasatuan["nama_matkul"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Semester</label>
                                                <select class="form-control" id="eid_semester">
                                                    <option value="">Pilih Semester</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbsemester");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_semester"]; ?>">
                                                            <?php echo $datasatuan["nama_semester"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Dosen</label>
                                                <select class="form-control" id="enip">
                                                    <option value="">Pilih Dosen</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbdosen");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["nip"]; ?>">
                                                            <?php echo $datasatuan["nama_dosen"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Ruangan</label>
                                                <select class="form-control" id="eid_ruang">
                                                    <option value="">Pilih Ruangan</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbruang");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_ruang"]; ?>">
                                                            <?php echo $datasatuan["nama_ruang"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                             
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Hari</label>
                                                <select class="form-control" id="ehari">
                                                    <option value="">Pilih Kelas</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Minggu">Minggu</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                
                                                <hr><p class="text-info">Waktu</p><hr>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Jam Awal</label>
                                                <input type="time" id="ejam_awal" name="ejam_awal"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="validation-username">Jam Akhir</label>
                                                <input type="time" id="ejam_akhir" name="ejam_akhir"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="beditjadwal">Edit</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Tutup -->

                    <div class="modal fade" id="konfirmasi_hapusjadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <input type="text" id="idhapus" name="idhapus" hidden="">
                                    <b>Anda yakin ingin hapus ini ?</b><br><br>
                                    <button type="submit" class="btn btn-danger btn-ok" id="bhapusjadwal">Iya</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                      <div class="modal fade" id="uploadexceldatasiswa" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Siswa</h5>
                                   
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exel">Masukkan File</label>
                                        <br />
                                        <input type="file" id="exel">
                                        <br />
                                        <small class="text-muted">File .xls (2003)</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="bimport">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
               
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
                    tampil = $("#table-example").DataTable({
                        "ajax": {
                            url: "modul/jadwal/aksi.php?adc=vjadwal",
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
                            search: "Cari Semua Kategori ",
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

                    $("#bsavejadwal").click(function () {
                        // alert('ok')
                        id_matkul     = $("#id_matkul").val();
                        id_semester     = $("#id_semester").val();
                        nip     = $("#nip").val();
                        id_ruang     = $("#id_ruang").val();
                        hari     = $("#hari").val();
                        jam_awal     = $("#jam_awal").val();
                        // 
                        jam_akhir     = $("#jam_akhir").val();

                        if (id_matkul == "") {
                            pwarning('Matakuliah Tidak Boleh Kosong');
                            $("#id_matkul").focus();
                        } else if (id_semester == "") {
                            pwarning('Semester Tidak Boleh Kosong');
                            $("#id_semester").focus();
                        } else if (nip == "") {
                            pwarning('Dosen Tidak Boleh Kosong');
                            $("#nip").focus();
                        } else if (id_ruang == "") {
                            pwarning('Ruangan Tidak Boleh Kosong');
                            $("#id_ruang").focus();
                        } else if (hari == "") {
                            pwarning('Hari Tidak Boleh Kosong');
                            $("#hari").focus();
                        } else if (jam_awal == "") {
                            pwarning('Jam Awal Tidak Boleh Kosong');
                            $("#jam_awal").focus();
                        } else if (jam_akhir == "") {
                            pwarning('Jam Akhir Tidak Boleh Kosong');
                            $("#jam_akhir").focus();
                        } 
                        else {
                            data = "id_matkul=" + id_matkul + "&id_semester=" + id_semester + "&nip=" + nip + "&id_ruang=" + id_ruang + "&hari=" + hari + "&jam_awal=" + jam_awal + "&jam_akhir=" + jam_akhir;
                            // alert(data)
                            $.ajax({
                                type: 'POST',
                                url: 'modul/jadwal/aksi.php?adc=sjadwal',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        $('#tambahdatajadwal').modal('hide');
                                        $('#id_matkul').val('');
                                        $('#id_semester').val('');
                                        $('#nip').val('');
                                        $('#id_ruang').val('');
                                        $('#hari').val('');
                                        $('#jam_awal').val('');
                                        $('#jam_akhir').val('');
                                        psukses('Data sudah tersimpan');
                                        tampil.ajax.reload(null, false);
                                       
                                    } else if (hasil==2) {
                                        pwarning('Jadwal Crash')
                                    }else{
                                        pgagal(''+hasil)
                                    }
                                }
                            });
                        }
                    });

                    $("#beditjadwal").click(function () {
                        id      = $("#id").val();
                        id_matkul     = $("#eid_matkul").val();
                        id_semester     = $("#eid_semester").val();
                        nip     = $("#enip").val();
                        id_ruang     = $("#eid_ruang").val();
                        hari     = $("#ehari").val();
                        jam_awal     = $("#ejam_awal").val();
                        // 
                        jam_akhir     = $("#ejam_akhir").val();

                        if (id_matkul == "") {
                            pwarning('Matakuliah Tidak Boleh Kosong');
                            $("#eid_matkul").focus();
                        } else if (id_semester == "") {
                            pwarning('Semester Tidak Boleh Kosong');
                            $("#eid_semester").focus();
                        } else if (nip == "") {
                            pwarning('Dosen Tidak Boleh Kosong');
                            $("#enip").focus();
                        } else if (id_ruang == "") {
                            pwarning('Ruangan Tidak Boleh Kosong');
                            $("#eid_ruang").focus();
                        } else if (hari == "") {
                            pwarning('Hari Tidak Boleh Kosong');
                            $("#ehari").focus();
                        } else if (jam_awal == "") {
                            pwarning('Jam Awal Tidak Boleh Kosong');
                            $("#ejam_awal").focus();
                        } else if (jam_akhir == "") {
                            pwarning('Jam Akhir Tidak Boleh Kosong');
                            $("#ejam_akhir").focus();
                        } 
                        else {
                            data = "id_matkul=" + id_matkul + "&id_semester=" + id_semester + "&nip=" + nip + "&id_ruang=" + id_ruang + "&hari=" + hari + "&jam_awal=" + jam_awal + "&jam_akhir=" + jam_akhir + "&id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/jadwal/aksi.php?adc=editjadwal',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pwarning('Data sudah terupdate');
                                        tampil.ajax.reload(null, false);
                                        $('#edtdatajadwal').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });
                     $("#bhapusjadwal").click(function () {
                        id      = $("#idhapus").val();
                            data = "id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/jadwal/aksi.php?adc=hjadwal',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pgagal('Data sudah terhapus');
                                        tampil.ajax.reload(null, false);
                                        $('#idhapus').val('');
                                        $('#konfirmasi_hapusjadwal').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        
                    });

                    $("#bimport").click(function (e) {
                        fileexel = $("#exel").prop("files")[0];
                        if (fileexel == "") {
                            pwarning('File Exel');
                        } else {
                            var form_data = new FormData();
                            form_data.append("fileexel", fileexel);
                            $.ajax({
                                type: 'POST',
                                url: 'modul/siswa/aksi.php?adc=sxlsiswa',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                success: function (hasil) {
                                    // alert(hasil);
                                    if (hasil == 0) {
                                        pgagal('Failed');
                                    } else {
                                        psukses('Data sudah ditambah ' + hasil + ' Siswa');
                                        $("#uploadexceldatasiswa").modal('hide');
                                        tampil.ajax.reload(null, false);
                                    }
                                }
                            });
                        }

                    });

                });
                function editData(id) {
                    if (id) {
                        $('#id').val(id);
                        $.ajax({
                            url: 'modul/jadwal/aksi.php?adc=edjadwal',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                $('#eid_matkul').val(response.id_matkul);
                                $('#eid_semester').val(response.id_semester);
                                $('#enip').val(response.nip);
                                $('#eid_ruang').val(response.id_ruang);
                                $('#ehari').val(response.hari);
                                $('#ejam_awal').val(response.jam_awal);
                                $('#ejam_akhir').val(response.jam_akhir);

                               
                               
                            }
                        });
                    } else {
                        alert("Error : Refresh the page again");
                    }
                }
                function hapusData(id) {
                    if (id) {
                        $('#idhapus').val(id);
                    } else {
                        alert("Error : Refresh the page again");
                    }
                }
            </script>