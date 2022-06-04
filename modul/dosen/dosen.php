<div class="row">
    <div class="col-lg-12">
        <h2> Dosen</h2>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#tambahdatadosen" data-toggle="modal" class="btn btn-success">
                                   <i class="icon-plus icon-white"></i> Tambah
                            </a>
                            <div style="float:right;">Data Dosen
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-example" width="100%" cellspacing="0">
                                       <thead>
                                           <tr>  
                                           <th width="50">No</th>
                                           <th>NIP</th>
                                           <th>Nama Dosen</th>
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
                <div class="modal fade" id="tambahdatadosen" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Tambah Dosen</h5>
                                </div>
                                <div class="modal-body">
                                     <div class="form-group">
                                        <label class="form-label" for="validation-username">Nip</label>
                                        <input type="number" id="nip" name="nip"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Nama Dosen</label>
                                        <input id="nama_dosen" name="nama_dosen"
                                               class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="bsavedosen">Simpan</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tutup -->
                     <!-- Edit Tambah -->
                    <div class="modal fade" id="edtdosen" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Edit dosen</h5>
                                </div> 
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" id="id" name="id" hidden="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Nip</label>
                                        <input type="number" id="enip" name="enip"
                                               class="form-control" disabled="disabled">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Nama Dosen</label>
                                        <input id="enama_dosen" name="enama_dosen"
                                               class="form-control">
                                    </div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="beditdosen">Edit</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tutup -->

                    <div class="modal fade" id="konfirmasi_hapusdosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <input type="text" id="idhapus" name="idhapus" hidden="">
                                    <b>Anda yakin ingin hapus ini ?</b><br><br>
                                    <button type="submit" class="btn btn-danger btn-ok" id="bhapusdosen">Iya</button>
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
                            url: "modul/dosen/aksi.php?adc=vdosen",
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

                    $("#bsavedosen").click(function () {
                        // alert('ok')
                        nip     = $("#nip").val();
                        nama_dosen     = $("#nama_dosen").val();
                        
                        if (nip == "") {
                            pwarning('nip Tidak Boleh Kosong');
                            $("#nip").focus();
                        } else if (nip == "") {
                            pwarning('NIP Tidak Boleh Kosong');
                            $("#nip").focus();
                        }else if (nama_dosen == "") {
                            pwarning('nama dosen Tidak Boleh Kosong');
                            $("#nama_dosen").focus();
                        }
                        else {
                            data = "nip=" + nip + "&nama_dosen=" + nama_dosen;
                            // alert(data)
                            $.ajax({
                                type: 'POST',
                                url: 'modul/dosen/aksi.php?adc=sdosen',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        $('#tambahdatadosen').modal('hide');
                                        $('#nip').val('');
                                        $('#nama_dosen').val('');
                                        psukses('Data sudah tersimpan');
                                        tampil.ajax.reload(null, false);
                                       
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });

                    $("#beditdosen").click(function () {
                        id      = $("#id").val();
                        nama_dosen     = $("#enama_dosen").val();
                       if (nama_dosen == "") {
                            pwarning('Nama Tidak Boleh Kosong');
                            $("#enama_dosen").focus();
                        }
                        else {
                            data = "nama_dosen=" + nama_dosen + "&id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/dosen/aksi.php?adc=editdosen',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pwarning('Data sudah terupdate');
                                        tampil.ajax.reload(null, false);
                                        $('#edtdosen').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });
                     $("#bhapusdosen").click(function () {
                        id      = $("#idhapus").val();
                            data = "id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/dosen/aksi.php?adc=hdosen',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pgagal('Data sudah terhapus');
                                        tampil.ajax.reload(null, false);
                                        $('#idhapus').val('');
                                        $('#konfirmasi_hapusdosen').modal('hide');
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
                            url: 'modul/dosen/aksi.php?adc=eddosen',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                $('#enip').val(response.nip);
                                $('#enama_dosen').val(response.nama_dosen);
                               
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