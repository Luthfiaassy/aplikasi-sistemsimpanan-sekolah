<?php
	include "../config/koneksi.php";

	$kode=$_GET['kode_user'];
	$kode_user=$_POST['kode_user'];
	$nama=$_POST['nama'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$level=$_POST['level'];	

		
 $sql = "SELECT * FROM tb_user WHERE username='$username'";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query) > 0){
 
echo'<script> alert("Maaf Tambah Data Gagal");
				window.location="../index.php?pilih=4.3&aksi=tambah"; </script>';
 
 } else {

 $sql =mysql_query("INSERT INTO tb_user VALUES('$kode_user','$nama','$username','$password','$level')");
 $query = mysql_query($sql);
 
echo'<script>
					alert("Tambah User berhasil");
					window.location="../index.php?pilih=4.3";
				</script>';		
 }
 ?>