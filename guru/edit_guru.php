<?php
include '../config/koneksi.php';
	
	$kode=$_GET['nip'];
	$nama_guru=$_GET['nama_guru'];
	$alamat=$_GET['alamat'];
	$telp_guru=$_GET['telp_guru'];
	$jk_guru=$_GET['jk_guru'];
	


$sql="SELECT * FROM tb_guru";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query)<1){
 
echo"<script>alert('Gagal di tambahkan!');history.go(-1);</script>";
 
 } else {
 	$sql =mysql_query("UPDATE tb_guru SET nama_guru='$nama_guru',alamat='$alamat',telp_guru='$telp_guru',jk_guru='$jk_guru' WHERE nip='$kode'");
  $query = mysql_query($sql) ; 
 
echo'<script>
					alert("Edit Data Guru Berhasil");
					window.location="../index.php?pilih=1.2";
				</script>';		
 }
 ?>