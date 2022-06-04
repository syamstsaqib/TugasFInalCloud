<div class="row">
    <div class="col-lg-12">
        <h2> Data Ruang </h2>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#tambahdataruang" data-toggle="modal" class="btn btn-success">
                                   <i class="icon-plus icon-white"></i> Tambah
                            </a>
                            <div style="float:right;">Ruangan
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-example" width="100%" cellspacing="0">
                                     <thead>
                                       <tr>  
                                       <th width="50">No</th>
                                       <th>Nama Ruang</th>
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
                <div class="modal fade" id="tambahdataruang" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Tambah Ruang</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Ruang</label>
                                        <input type="text" id="nama_ruang" name="nama_ruang"
                                               class="form-control">
                                    </div>
                                     
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="bsaveruang">Simpan</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tutup -->
                     <!-- Edit Tambah -->
                    <div class="modal fade" id="edtruang" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Edit Ruang</h5>
                                </div> 
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" id="id" name="id" hidden="">
                                        <label class="form-label" for="validation-username">Nama Ruang</label>
                                        <input type="text" id="enama_ruang" name="enama_ruang"
                                               class="form-control">
                                    </div>
                                     
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="beditruang">Edit</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tutup -->
                    <div class="modal fade" id="konfirmasi_hapusruang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <input type="text" id="idhapus" name="idhapus" hidden="">
                                    <b>Anda yakin ingin hapus ini ?</b><br><br>
                                    <button type="submit" class="btn btn-danger btn-ok" id="bhapusruang">Iya</button>
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
                            url: "modul/ruang/aksi.php?adc=vruang",
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

                    $("#bsaveruang").click(function () {
                        // alert('ok')
                       
                        nama_ruang     = $("#nama_ruang").val();
                        if (nama_ruang == "") {
                            pwarning('Nama Ruang Tidak Boleh Kosong');
                            $("#nama_ruang").focus();
                        } 
                        else {
                            data = "nama_ruang=" + nama_ruang;
                            // alert(data)
                            $.ajax({
                                type: 'POST',
                                url: 'modul/ruang/aksi.php?adc=sruang',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        $('#tambahdataruang').modal('hide');
                                        $('#nama_ruang').val('');
                                        psukses('Data sudah tersimpan');
                                        tampil.ajax.reload(null, false);
                                       
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });

                    $("#beditruang").click(function () {
                        id      = $("#id").val();
                        nama_ruang     = $("#enama_ruang").val();
                      
                        if (nama_ruang == "") {
                            pwarning('Nama Ruang Tidak Boleh Kosong');
                            $("#enama_ruang").focus();
                        } 
                        else {
                            data = "nama_ruang=" + nama_ruang + "&id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/ruang/aksi.php?adc=editruang',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pwarning('Data sudah terupdate');
                                        tampil.ajax.reload(null, false);
                                        $('#edtruang').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });
                     $("#bhapusruang").click(function () {
                        id      = $("#idhapus").val();
                            data = "id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/ruang/aksi.php?adc=hruang',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pgagal('Data sudah terhapus');
                                        tampil.ajax.reload(null, false);
                                        $('#idhapus').val('');
                                        $('#konfirmasi_hapusruang').modal('hide');
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
                            url: 'modul/ruang/aksi.php?adc=edruang',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                $('#enama_ruang').val(response.nama_ruang);
                               
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