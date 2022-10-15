<?php
	include "../config/koneksi.php";
	
	$pros=$_GET['pros'];
	$kode=$_GET['nis'];
	$nis=$_POST['nis'];
	$setoran=$_POST['setoran'];
	$nama_siswa=$_POST['nama_siswa'];
    $kelas=$_POST['kelas'];
	$alamat=$_POST['alamat'];
	$telp_siswa=$_POST['telp_siswa'];
	$jk_siswa=$_POST['jk_siswa'];
	$tgl_entri=$_POST['tgl_entri'];
	
switch ($pros){
		
	
		case "hapus" :
		$kode=$_GET['nis'];
	
			mysql_query("DELETE FROM tb_tabungansiswa where nis='$kode'");
			mysql_query("DELETE FROM tb_pengambilansiswa where nis='$kode'");
mysql_query("DELETE FROM tb_anggota WHERE nis='$kode'");
echo'
<script type="text/javascript">
alert("Hapus Data Berhasil");
     window.location="../index.php?pilih=1.4";
    }else{

    window.location="../index.php?pilih=1.4";

    }
</script>';
			break;
		default : break; 
	}
?>
		