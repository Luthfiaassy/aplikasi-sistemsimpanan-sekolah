<?php
include '../config/koneksi.php';


	
	$kode=$_GET['nip'];
	$nama_kepsek=$_GET['nama_kepsek'];
   
	$alamat=$_GET['alamat'];
	$telp_kepsek=$_GET['telp_kepsek'];
	$jenis_kelamin=$_GET['jenis_kelamin'];
	


$sql="SELECT * FROM tb_kepalasekolah";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query)<1){
 
echo"<script>alert('Gagal di tambahkan!');history.go(-1);</script>";
 
 } else {
 	$sql =mysql_query("UPDATE tb_kepalasekolah SET nama_kepsek='$nama_kepsek',alamat='$alamat',telp_kepsek='$telp_kepsek',jenis_kelamin='$jenis_kelamin' WHERE nip='$kode'");
  $query = mysql_query($sql) ; 
 
echo'<script>
					alert("Edit Data Kepala Saekolah Berhasil");
					window.location="../index.php?pilih=1.1";
				</script>';		
 }
 ?>