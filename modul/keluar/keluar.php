<?php
	session_destroy();
	echo "<br><br><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button>
                                              <strong></strong> Anda Berhasil Keluar
                                            </div>";
	echo "<meta http-equiv='refresh' content='1; url=index.php'>";
?>