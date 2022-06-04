<div class="row">
    <div class="col-lg-12">
        <h2> Mahasiswa</h2>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#tambahdatamahasiswa" data-toggle="modal" class="btn btn-success">
                                   <i class="icon-plus icon-white"></i> Tambah
                            </a>
                            <div style="float:right;">Data Mahasiswa
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-example" width="100%" cellspacing="0">
                                       <thead>
                                           <tr>  
                                           <th width="50">No</th>
                                           <th>Nim</th>
                                           <th>Nama Mahasiswa</th>
                                           <th>Semester</th>
                                           <th>Foto</th>
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
                <div class="modal fade" id="tambahdatamahasiswa" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                             <form method="post" id="actiontambahdata" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Tambah Mahasiswa</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Nim</label>
                                        <input type="number" id="nim" name="nim"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Nama Mahasiswa</label>
                                        <input id="nama_mahasiswa" name="nama_mahasiswa"
                                               class="form-control">
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label" for="validation-username">Semester</label>
                                        <select class="form-control" id="id_semester" name="id_semester">
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
                                        <label class="form-label" for="validation-username">Upload Foto</label>
                                        <input type="file" id="uploadfoto" name="uploadfoto"
                                               class="form-control">
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label" for="validation-username">Password</label>
                                        <input type="password" id="password" name="password"
                                               class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="bsavemahasiswa">Simpan</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                         </form>
                        </div>
                    </div>
                    <!-- Tutup -->
                     <!-- Edit Tambah -->
                    <div class="modal fade" id="edtmahasiswa" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" id="actioneditdata" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Edit Mahasiswa</h5>
                                </div> 
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" id="id" name="id" hidden="">
                                        <label class="form-label" for="validation-username">Nim</label>
                                        <input id="enim" name="enim"
                                               class="form-control" disabled="disabled">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Nama MAHASISWA</label>
                                        <input id="enama_mahasiswa" name="enama_mahasiswa"
                                               class="form-control">
                                    </div>
                                     <div class="form-group">
                                        <label class="form-label" for="validation-username">Semester</label>
                                        <select class="form-control" id="eid_semester" name="eid_semester">
                                            <option value="">Pilih</option>
                                            <?php 
                                            $sqlsatuan=mysqli_query($con,"SELECT * from tbsemester");
                                            while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                <option value="<?php echo $datasatuan["id_semester"]; ?>">
                                                    <?php echo $datasatuan["nama_semester"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Upload Foto</label>
                                        <input type="file" id="euploadfoto" name="euploadfoto"
                                               class="form-control">
                                        <span id="user_uploaded_image"></span>
                                        <label class="form-label" style="color:red;">Kosongkan jika tidak ada Perubahan</label>
                                    </div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="beditmahasiswa">Edit</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                    <!-- Tutup -->

                    <div class="modal fade" id="konfirmasi_hapusmahasiswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <input type="text" id="idhapus" name="idhapus" hidden="">
                                    <b>Anda yakin ingin hapus ini ?</b><br><br>
                                    <button type="submit" class="btn btn-danger btn-ok" id="bhapusmahasiswa">Iya</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
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
                    tampil = $("#table-example").DataTable({
                        "ajax": {
                            url: "modul/mahasiswa/aksi.php?adc=vmahasiswa",
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
                            search: "Cari ",
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
                    $(document).on('submit', '#actiontambahdata', function(event){
                        event.preventDefault();
                        var nim     = $("#nim").val();
                        var nama_mahasiswa     = $("#nama_mahasiswa").val();
                        var id_semester     = $("#id_semester").val();
                        var uploadfoto = $('#uploadfoto').val();
                         var password = $('#password').val();
                        if (nim == "") {
                            pwarning('Nim Tidak Boleh Kosong');
                            $("#nim").focus();
                        } else if (nama_mahasiswa == "") {
                            pwarning('nama mahasiswa Tidak Boleh Kosong');
                            $("#nama_mahasiswa").focus();
                        }else if (id_semester == "") {
                            pwarning('Semester Tidak Boleh Kosong');
                            $("#id_semester").focus();
                        }else if (uploadfoto == "") {
                            pwarning('Semester Tidak Boleh Kosong');
                            $("#uploadfoto").focus();
                        }else if (password == "") {
                            pwarning('Password Tidak Boleh Kosong');
                            $("#password").focus();
                        }
                        else {
                            $.ajax({
                                method: 'POST',
                                url: 'modul/mahasiswa/aksi.php?adc=smahasiswa',
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        $('#tambahdatamahasiswa').modal('hide');
                                        $('#nim').val('');
                                        $('#nama_mahasiswa').val('');
                                        $('#id_semester').val('');
                                        $('#uploadfoto').val('');
                                        $('#password').val('');
                                        psukses('Data sudah tersimpan');
                                        tampil.ajax.reload(null, false);
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });

                    // $("#bsavemahasiswa").click(function () {
                    //     // alert('ok')
                    //     nim     = $("#nim").val();
                    //     nama_mahasiswa     = $("#nama_mahasiswa").val();
                    //     id_semester     = $("#id_semester").val();
                    //     if (nim == "") {
                    //         pwarning('Nim Tidak Boleh Kosong');
                    //         $("#nim").focus();
                    //     } else if (nama_mahasiswa == "") {
                    //         pwarning('nama mahasiswa Tidak Boleh Kosong');
                    //         $("#nama_mahasiswa").focus();
                    //     }else if (id_semester == "") {
                    //         pwarning('Semester Tidak Boleh Kosong');
                    //         $("#id_semester").focus();
                    //     }
                    //     else {
                    //         data = "nim=" + nim + "&nama_mahasiswa=" + nama_mahasiswa + "&id_semester=" + id_semester;
                    //         // alert(data)
                    //         $.ajax({
                    //             type: 'POST',
                    //             url: 'modul/mahasiswa/aksi.php?adc=smahasiswa',
                    //             data: data,
                    //             success: function (hasil) {
                    //                 if (hasil == 1) {
                    //                     $('#tambahdatamahasiswa').modal('hide');
                    //                     $('#nim').val('');
                    //                     $('#nama_mahasiswa').val('');
                    //                     $('#id_semester').val('');
                    //                     psukses('Data sudah tersimpan');
                    //                     tampil.ajax.reload(null, false);
                                       
                    //                 } else {
                    //                     pgagal('Failed')
                    //                 }
                    //             }
                    //         });
                    //     }
                    // });

                    // $("#beditmahasiswa").click(function () {
                    //     id      = $("#id").val();
                    //     nama_mahasiswa     = $("#enama_mahasiswa").val();
                    //     id_semester     = $("#eid_semester").val();
                    //    if (nama_mahasiswa == "") {
                    //         pwarning('nama mahasiswa Tidak Boleh Kosong');
                    //         $("#enama_mahasiswa").focus();
                    //     }else if (id_semester == "") {
                    //         pwarning('Semester Tidak Boleh Kosong');
                    //         $("#eid_semester").focus();
                    //     }
                    //     else {
                    //         data = "nama_mahasiswa=" + nama_mahasiswa + "&id_semester=" + id_semester + "&id=" + id;
                    //         $.ajax({
                    //             type: 'POST',
                    //             url: 'modul/mahasiswa/aksi.php?adc=editmahasiswa',
                    //             data: data,
                    //             success: function (hasil) {
                    //                 if (hasil == 1) {
                    //                     pwarning('Data sudah terupdate');
                    //                     tampil.ajax.reload(null, false);
                    //                     $('#edtmahasiswa').modal('hide');
                    //                 } else {
                    //                     pgagal('Failed')
                    //                 }
                    //             }
                    //         });
                    //     }
                    // });
                    $(document).on('submit', '#actioneditdata', function(event){
                        event.preventDefault();
                        id      = $("#id").val();
                        var nama_mahasiswa     = $("#enama_mahasiswa").val();
                        var id_semester     = $("#eid_semester").val();
                       if (nama_mahasiswa == "") {
                            pwarning('nama mahasiswa Tidak Boleh Kosong');
                            $("#enama_mahasiswa").focus();
                        }else if (id_semester == "") {
                            pwarning('Semester Tidak Boleh Kosong');
                            $("#eid_semester").focus();
                        } 
                        else {
                            $.ajax({
                                method: 'POST',
                                url: 'modul/mahasiswa/aksi.php?adc=editmahasiswa',
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pwarning('Data sudah terupdate');
                                        tampil.ajax.reload(null, false);
                                        $('#edtmahasiswa').modal('hide');
                                    } else {
                                        pgagal('Failed');
                                    }
                                }
                            });
                        }
                    });
                     $("#bhapusmahasiswa").click(function () {
                        id      = $("#idhapus").val();
                            data = "id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/mahasiswa/aksi.php?adc=hmahasiswa',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pgagal('Data sudah terhapus');
                                        tampil.ajax.reload(null, false);
                                        $('#idhapus').val('');
                                        $('#konfirmasi_hapusmahasiswa').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        
                    });

                });
                function editData(id) {
                    if (id) {
                        $('#id').val(id);
                        $.ajax({
                            url: 'modul/mahasiswa/aksi.php?adc=edmahasiswa',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                $('#enim').val(response.nim);
                                $('#enama_mahasiswa').val(response.nama_mahasiswa);
                                $('#eid_semester').val(response.id_semester);
                             
                               
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