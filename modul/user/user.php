
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Data User</h5>
               <a href="#tambahdatahafalan" data-toggle="modal" class="btn btn-success btn-circle" style="float:right;">
                    <i class="fas fa-plus"></i>
               </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="table-example" width="100%" cellspacing="0">
                     <thead>
                       <tr>  
                       <th>No</th>
                       <th>User</th>
                       <th>Hak Akses</th>
                       <th>Nama</th>
                       <th>Aksi</th>
                       </tr>
                       </thead>
                 </table> 
                </div>
            </div>
</div>





<script type="text/javascript">
        function pwarning(pesan) {
                    toastr.warning(
                    pesan,
                    "Informasi",
                    {progressBar: !0}
                )
                }
                function psukses(pesan) {
                    toastr.success(
                    pesan,
                    "Informasi",
                    {progressBar: !0}
                )
                }
                function pgagal(pesan) {
                    toastr.error(
                    pesan,
                    "Informasi",
                    {progressBar: !0}
                )
                }
                function pinfo(pesan) {
                    toastr.info(
                    pesan,
                    "Informasi",
                    {progressBar: !0}
                )
                }
                var tampil;
                $(document).ready(function () {
                    tampil = $("#table-example").DataTable({
                        "ajax": {
                            url: "modul/user/aksi.php?adc=vuser",
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
                            search: "Cari dapat semua Kategori",
                            "paginate": {
                              "previous": 'Sebelum <i class="fa fa-angle-left"></i> ',
                              "next": '<i class="fa fa-angle-right"></i> Selanjutnya'
                            }
                        }
                    });
                $("#bsavependuduk").click(function () {
                        // alert('ok')
                        nik     = $("#nik").val();
                        nama    = $("#nama").val();
                        tgl_lahir    = $("#tgl_lahir").val();
                        jk    = $("#jk").val();
                        alamat    = $("#alamat").val();
                        status    = $("#status").val();
                        if (nik == "") {
                            pwarning('Nik Tidak Boleh Kosong');
                            $("#nik").focus();
                        }else if (nama == "") {
                            pwarning('Nama Tidak Boleh Kosong');
                            $("#nama").focus();
                        }else if (tgl_lahir == "") {
                            pwarning('TGL Tidak Boleh Kosong');
                            $("#tgl_lahir").focus();
                        }else if (jk == "") {
                            pwarning('Jenis Tidak Boleh Kosong');
                          
                        }else if (status == "") {
                            pwarning('Status Tidak Boleh Kosong');
                          
                        }
                        else {
                            data = "nik=" + nik + "&nama=" + nama+ "&tgl_lahir=" + tgl_lahir+ "&jk=" + jk+ "&alamat=" + alamat+ "&status=" + status;
                            // alert(data)
                            $.ajax({
                                type: 'POST',
                                url: 'modul/penduduk/aksi.php?adc=spenduduk',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        psukses('Data sudah tersimpan');
                                        tampil.ajax.reload(null, false);
                                        $('#tambahData').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });
                $("#beditpenduduk").click(function () {
                        id      = $("#id").val();
                        nama    = $("#enama").val();
                        tgl_lahir    = $("#etgl_lahir").val();
                        alamat    = $("#ealamat").val();
                        nohp    = $("#enohp").val();
                        pekerjaan    = $("#epekerjaan").val();
                        status    = $("#estatus").val();
                        if (nama == "") {
                            pwarning('nama Kosong');
                            $("#enama").focus();
                        }else if (tgl_lahir == "") {
                            pwarning('tgl Kosong');
                            $("#etgl_lahir").focus();
                        }else if (nohp == "") {
                            pwarning('No Hp Kosong');
                            $("#ejk").focus();
                        }else if (alamat == "") {
                            pwarning('Alamat Kosong');
                            $("#ealamat").focus();
                        }else if (status == "") {
                            pwarning('Status Kosong');
                            $("#estatus").focus();
                        }
                        else {
                            data = "nik=" + nik + "&nama=" + nama + "&tgl_lahir=" + tgl_lahir + "&alamat=" + alamat + "&nohp=" + nohp + "&pekerjaan=" + pekerjaan  + "&status=" + status + "&id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'modul/penduduk/aksi.php?adc=editpenduduk',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        psukses('Data sudah terupdate');
                                        tampil.ajax.reload(null, false);
                                        $('#editdata').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
                        }
                    });
                $("#bhapus").click(function () {
                        id      = $("#id").val();
          
                            data = "id=" + id;
                            $.ajax({
                                type: 'POST',
                                url: 'aksi.php?adc=hkader',
                                data: data,
                                success: function (hasil) {
                                    if (hasil == 1) {
                                        psukses('Data sudah terhapus');
                                        tampil.ajax.reload(null, false);
                                        $('#hpskader').modal('hide');
                                    } else {
                                        pgagal('Failed')
                                    }
                                }
                            });
       
                    });
                $("#bimport").click(function (e) {
                        fileexel    = $("#exel").prop("files")[0];
                        if (fileexel == "") {
                            pwarning('File Exel');
                        } else {
                            var form_data = new FormData();
                            form_data.append("fileexel", fileexel);

                            var $progressbar = $("#progressbar");
                            $progressbar.show();
                            var updateProgressBar = function(evt) {
                                if(evt.lengthComputable) {
                                    var percent = (evt.loaded*100)/evt.total;
                                    $(function(){
                                        $progressbar.css('width', percent.toFixed(1) + '%');
                                    }); 
                                }
                            }
                            $.ajax({
                                xhr: function() {
                                    var req = new XMLHttpRequest();
                                    req.upload.addEventListener("progress", updateProgressBar, false);
                                    req.addEventListener("progress", updateProgressBar, false);
                                    return req;
                                },
                                type: 'POST',
                                url: 'modul/penduduk/aksi.php?adc=sxlpenduduk',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                success: function (hasil) {
                                    // $progressbar.css('width', hasil + '%');
                                    if (hasil == 0) {
                                        pgagal('Failed');
                                    }else if(hasil == 2){
                                        pwarning('nik ada yang kosong');
                                    } else {
                                        psukses('Data sudah ditambah ' + hasil + ' Penduduk');
                                        $("#uploadData").modal('hide');
                                        $('#exel').val("");  
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
                            url: 'modul/penduduk/aksi.php?adc=edpenduduk',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                $('#enama').val(response.nama_penduduk);
                                $('#etgl_lahir').val(response.tgl_lahir);
                                $('#ealamat').val(response.alamat);
                                $('#enohp').val(response.nohp);
                                $('#epekerjaan').val(response.pekerjaan);
                                $('#estatus').val(response.status_akun);
                            }
                        });
                    } else {
                        alert("Error : Refresh the page again");
                    }
                }
              function hapusData(id) {
                     if (id) {
                        $('#id').val(id);
                        $.ajax({
                            url: 'modul/kritik/aksi.php?adc=hkritik',
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            success: function (response) {
                                if (response == 1) {
                                          psukses('Data sudah di Selesai');
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
                function hapusall(){
                    $.ajax({
                        type: 'POST',
                        url: 'modul/penduduk/aksi.php?adc=hpsall',
                        success: function (hasil) {
                            if (hasil == 1) {
                                psukses('Data sudah terhapus semua');
                                tampil.ajax.reload(null, false);
                            } else {
                                pgagal('Failed')
                            }
                        }
                    });
                }
        </script>