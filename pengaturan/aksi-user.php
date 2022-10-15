<?php
	include "../config/koneksi.php";

	$pros=$_GET['pros'];
	$kode=$_GET['kode_user'];
	$kode_user=$_POST['kode_user'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$nama=$_POST['nama'];
	$no_identitas=$_POST['no_identitas'];
	$alamat=$_POST['alamat'];
	$no_telp=$_POST['no_telp'];
	$jenis_kelamin=$_POST['jenis_kelamin'];
	$tgl_entri=$_POST['tgl_entri'];
	$level=$_POST['level'];	

	switch ($pros)
	{
		case "hapus" :
			$qdelete=mysql_query("DELETE FROM tb_user WHERE kode_user='$kode'");
			if($qdelete){?>
				<script>
					alert("Hapus Data Berhasil");
					window.location="../index.php?pilih=4.3";
				</script>
				<?php
			}else{
				echo'<script> alert("Maaf Hapus Data Gagal");
				window.location="../index.php?pilih=4.3";</script>';}
		default : break; 
	}

?>