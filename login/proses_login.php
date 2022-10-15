<?php
session_start();

include "../config/koneksi.php";

// Dikirim dari form
$username=$_POST['username'];
$password=$_POST['password'];
$query=mysql_query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
$jumlah=mysql_num_rows($query);
$a=mysql_fetch_array($query);

if($jumlah > 0){
	if($a['level']=='admin')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['id']=$a['kode_user'];
	$_SESSION['name']=$a['nama'];
	header("location:../index.php?pilih=home");
	}
	else if($a['level']=='operator')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['id']=$a['kode_user'];
	$_SESSION['name']=$a['nama'];
	header("location:../index.php?pilih=home");
	}
	else if($a['level']=='kepsek')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['id']=$a['kode_user'];
	$_SESSION['name']=$a['nama'];
	header("location:../index.php?pilih=home");
	}
	else if($a['level']=='walikelas')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['id']=$a['kode_user'];
	$_SESSION['name']=$a['nama'];
	header("location:../index.php?pilih=home");
	}
	else if($a['level']=='guru')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['id']=$a['kode_user'];
	$_SESSION['name']=$a['nama'];
	header("location:../index.php?pilih=home");
	}
	else if($a['level']=='siswa')
	{
	$_SESSION['level']=$a['level'];
	$_SESSION['id']=$a['kode_user'];
	$_SESSION['name']=$a['nama'];
	header("location:../index.php?pilih=home");
}
   	
}else{
?>
	<script>
		alert("Username Atau Password Salah");
		window.location="login.php";
	</script>
<?php
}
?>