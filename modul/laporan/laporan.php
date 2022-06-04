<div class="row">
    <div class="col-lg-12">
        <h2> Jadwal</h2>
    </div>
</div>
<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Absensi</h5>
			<hr />
			<form method="POST" role="form" id="FormLaporan">
			<div class="row">
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Semester</label>
							<div class="col-sm-8">
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
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Matakuliah</label>
							<div class="col-sm-8">
								<select class="form-control" id="id_matkul" name="id_matkul">
                                    <option value="">Pilih Matakuliah</option>
                                                    <?php 
                                                    $sqlsatuan=mysqli_query($con,"SELECT * from tbmatkul");
                                                    while($datasatuan=mysqli_fetch_array($sqlsatuan)){ ?>
                                                        <option value="<?php echo $datasatuan["id_matkul"]; ?>">
                                                            <?php echo $datasatuan["nama_matkul"]; ?></option>
                                                    <?php } ?>
                                </select>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Dari Tanggal</label>
							<div class="col-sm-8">
								<input type='text' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Sampai Tanggal</label>
							<div class="col-sm-8">
								<input type='text' name='to' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
			</div>	

			<div class='row'>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>

			<br />
			<div id='result'></div>
		</div>
	</div>
<link rel="stylesheet" type="text/css" href="assets/datetimepicker/jquery.datetimepicker.css"/>
<script src="assets/datetimepicker/jquery.datetimepicker.js"></script>

<script>
$('#tanggal_dari').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	closeOnDateSelect:true
});
$('#tanggal_sampai').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	closeOnDateSelect:true
});
$(document).ready(function(){

	$(document).on('submit', '#FormLaporan', function(event){
                        event.preventDefault();
                        var TanggalDari = $('#tanggal_dari').val();
						var TanggalSampai = $('#tanggal_sampai').val();
                       if (TanggalDari == "") {
                            pwarning('nama mahasiswa Tidak Boleh Kosong');
                            $("#tanggal_dari").focus();
                        }else if (TanggalSampai == "") {
                            pwarning('Semester Tidak Boleh Kosong');
                            $("#tanggal_sampai").focus();
                        } 
                        else {
                            $.ajax({
                                method: 'POST',
                                url: 'modul/laporan/tampillaporan.php',
                                data:new FormData(this),
                                contentType:false,
                                processData:false,
                                success: function (hasil) {
                                    $('#result').html(hasil);
                                }
                            });
                        }
                    });
});
</script>
