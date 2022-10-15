<?php
	include "../config/koneksi.php";
	
	$kode=$_GET['nis'];
	$nip=$_POST['nip'];	
	$nama_guru=$_POST['nama_guru'];
	$alamat=$_POST['alamat'];
	$telp_guru=$_POST['telp_guru'];
	$setoran =$_POST['setoran'];
	$jk_guru=$_POST['jk_guru'];
	
	$tgl_entri =$_POST['tgl_entri'];
	
$sql = "SELECT * FROM tb_guru WHERE nip='$nip'";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query) > 0){
 
echo'<script> alert("Maaf Tambah Data Gagal");
				history.go(-1); </script>';
 
 } else {
$q=mysql_fetch_array(mysql_query("SELECT * FROM tb_guru WHERE setoran='awal'"));
		$awal=$q['setoran'];
			$qu=mysql_query("INSERT INTO tb_tabungan VALUES('','$nip','$tgl_entri','$setoran')");
			$que=mysql_query("SELECT max(kode_tabungan) AS a FROM tb_tabungan");
			$dt = mysql_fetch_array($que);
 $sql =mysql_query("INSERT INTO tb_guru values('$nip','$nama_guru','$alamat','$telp_guru','$setoran','$jk_guru','$tgl_entri')");   
 $query = mysql_query($sql);
 
echo'<script>
					alert("Tambah Data Guru Berhasil");
					window.location="../index.php?pilih=1.2";
				</script>';		
 }
 ?>