<div class="row">
    <div class="col-lg-12">
        <h2> Data MataKuliah</h2>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#tambahdatamatakuliah" data-toggle="modal" class="btn btn-success">
                                   <i class="icon-plus icon-white"></i> Tambah
                            </a>
                            <div style="float:right;">Matakuliah
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-example" width="100%" cellspacing="0">
                                     <thead>
                                       <tr>  
                                       <th width="50">No</th>
                                       <th>Matakuliah</th>
                                       <th>SKS</th>
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
                <div class="modal fade" id="tambahdatamatakuliah" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Tambah Matakuliah</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Matakuliah</label>
                                        <input id="nama_matkul" name="nama_matkul"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">SKS</label>
                                        <input type="number" id="sks" name="sks"
                                               class="form-control">
                                    </div>                                     
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="bsavematakuliah">Simpan</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tutup -->
                     <!-- Edit Tambah -->
                    <div class="modal fade" id="edtmatakuliah" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title">Edit Matakuliah</h5>
                                </div> 
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id" hidden="">
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">Matakuliah</label>
                                        <input id="enama_matkul" name="enama_matkul"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="validation-username">SKS</label>
                                        <input type="number" id="esks" name="esks"
                                               class="form-control">
                                    </div>  
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="beditmatakuliah">Edit</button>
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tutup -->
                    <div class="modal fade" id="konfirmasi_hapusmatakuliah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <input type="text" id="idhapus" name="idhapus" hidden="">
                                    <b>Anda yakin ingin hapus ini ?</b><br><br>
                                    <button type="submit" class="btn btn-danger btn-ok" id="bhapusmatakuliah">Iya</button>
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
                            url: "modul/matakuliah/aksi.php?adc=vmatakuliah",
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

                    $("#bsavematakuliah").click(function () {
                        // alert('ok')
                        nama_matkul     = $("#nama_matkul").val();
                        sks     = $("#sks").val();                        
                        if (nama_matkul == "") {
                            pwarning('Nama Matakuliah Tidak Boleh Kosong');
                            $("#nama_matkul").focus();
                        }else if (sks == "") {
                            pwarning('SKS Tidak Boleh Kosong');
                            $("#sks").focus();
                        } 
                        else {
                            data = "nama_matkul=" + nama_matkul + "&sks=" + sks;
                            // alert(data)
                            $.ajax({
                                type: 'POST',
                                url: 'modul/matakuliah/aksi.php?adc=smatakuliah',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        $('#tambahdatamatakuliah').modal('hide');
                                        $('#nama_matkul').val('');
                                        $('#sks').val('');
                                        psukses('Data sudah tersimpan');
                                        tampil.ajax.reload(null, false);
                                       
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });

                    $("#beditmatakuliah").click(function () {
                        id      = $("#id").val();
                        nama_matkul     = $("#enama_matkul").val();
                        sks     = $("#esks").val();
                        if (nama_matkul == "") {
                            pwarning('Nama Matakuliah Tidak Boleh Kosong');
                            $("#enama_matkul").focus();
                        } else if (sks == "") {
                            pwarning('SKS Tidak Boleh Kosong');
                            $("#esks").focus();
                        } 
                        else {
                            data = "nama_matkul=" + nama_matkul+ "&sks=" + sks + "&id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/matakuliah/aksi.php?adc=editmatakuliah',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pwarning('Data sudah terupdate');
                                        tampil.ajax.reload(null, false);
                                        $('#edtmatakuliah').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });
                     $("#bhapusmatakuliah").click(function () {
                        id      = $("#idhapus").val();
                            data = "id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/matakuliah/aksi.php?adc=hmatakuliah',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        pgagal('Data sudah terhapus');
                                        tampil.ajax.reload(null, false);
                                        $('#idhapus').val('');
                                        $('#konfirmasi_hapusmatakuliah').modal('hide');
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
                            url: 'modul/matakuliah/aksi.php?adc=edmatakuliah',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                $('#enama_matkul').val(response.nama_matkul);
                                $('#esks').val(response.sks);                               
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