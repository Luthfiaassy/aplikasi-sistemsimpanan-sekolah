<?php
	include "../config/koneksi.php";
	
	$kode=$_GET['nip'];
	$nip=$_POST['nip'];
	
	$nama_kepsek=$_POST['nama_kepsek'];
   
	$alamat=$_POST['alamat'];
	$telp_kepsek=$_POST['telp_kepsek'];
	$jenis_kelamin=$_POST['jenis_kelamin'];
	
	
$sql = "SELECT * FROM tb_kepsek WHERE nip='$nip'";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query) > 0){
 
echo'<script> alert("Maaf Tambah Data Gagal");
				history.go(-1); </script>';
 
 } else {
 $sql =mysql_query("INSERT INTO tb_kepalasekolah values('$nip','$nama_kepsek','$alamat','$telp_kepsek','$jenis_kelamin')");   
 $query = mysql_query($sql);
 
echo'<script>
					alert("Tambah Data Kepala Sekolah Berhasil");
					window.location="../index.php?pilih=1.1";
				</script>';		
 }
 ?>