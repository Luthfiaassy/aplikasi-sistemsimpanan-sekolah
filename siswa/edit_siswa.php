<?php
include '../config/koneksi.php';
$nis=$_POST['nis'];
$nama_siswa=$_POST['nama_siswa'];
$kelas=$_POST['kelas'];
$alamat=$_POST['alamat'];
$telp_siswa=$_POST['telp_siswa'];
$jk_siswa=$_POST['jk_siswa'];
$tgl_entri=$_POST['tgl_entri'];



$sql = "SELECT * FROM tb_siswa";
 $query = mysql_query($sql) ;
 
 if(mysql_num_rows($query) == 0){
 
echo"<script>alert('Gagal di tambahkan!');history.go(-1);</script>";
 
 } else {
 	$sql =mysql_query("UPDATE tb_siswa SET nama_siswa='$nama_siswa',kelas='$kelas',alamat='$alamat',telp_siswa='$telp_siswa',jk_siswa='$jk_siswa',tgl_entri='$tgl_entri' WHERE nis='$nis'");
  $query = mysql_query($sql) ; 
 
echo'<script>
					alert("Edit Data Siswa Berhasil");
					window.location="../index.php?pilih=1.4";
				</script>';		
 }
 ?>