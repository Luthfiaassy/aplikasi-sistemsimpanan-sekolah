<?php
	include "../config/koneksi.php";

	$username=$_POST['username'];
	$password=$_POST['password'];
	$nama=$_POST['nama'];
	$level=$_POST['level'];	
    $kode=$_POST['kode_user'];

    $sql = "SELECT * FROM tb_user WHERE kode_user='$kode'";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query)>1){
 
echo"<script>alert('Gagal di tambahkan!');history.go(-1);</script>";
 
 } else {
    
		$sql=mysql_query("UPDATE tb_user SET username='$username',password='$password',nama='$nama',level='$level' WHERE kode_user='$kode'");
			$query = mysql_query($sql) ; 
 
echo'<script>
					alert("Edit Data User Berhasil");
					window.location="../index.php?pilih=4.3";
				</script>';		
 }
 ?>