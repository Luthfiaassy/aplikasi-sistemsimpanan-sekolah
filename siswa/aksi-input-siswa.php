<?php
	include "../config/koneksi.php";
	
	$kode=$_GET['nis'];
	$nis=$_POST['nis'];
	$setoran=$_POST['setoran'];
	$nama_siswa=$_POST['nama_siswa'];
	$kelas=$_POST['kelas'];
	$jk_siswa=$_POST['jk_siswa'];
$alamat=$_POST['alamat'];
	$telp_siswa=$_POST['telp_siswa'];
	$tgl_entri=$_POST['tgl_entri'];
	
$sql = "SELECT * FROM tb_siswa WHERE nis='$nis'";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query) > 0){
 
echo'<script> alert("Maaf Tambah Data Gagal");
				history.go(-1); </script>';
 
 } else {
$q=mysql_fetch_array(mysql_query("SELECT * FROM tb_siswa WHERE setoran='awal'"));
		$awal=$q['setoran'];
			$qu=mysql_query("INSERT INTO tb_tabungansiswa VALUES('','$nis','$tgl_entri','$setoran')");
			$que=mysql_query("SELECT max(kode_tabungan) AS a FROM tb_tabungansiswa");
			$dt = mysql_fetch_array($que);
 $sql =mysql_query("INSERT INTO tb_siswa values('$nis','$nama_siswa','$kelas','$alamat','$telp_siswa','$setoran','$jk_siswa','$tgl_entri')");   
 $query = mysql_query($sql);
 
echo'<script>
					alert("Tambah Data Siswa Berhasil");
					window.location="../index.php?pilih=1.4";
				</script>';		
 }
 ?>