<?php
session_start();
$nip=$_GET['nip'];
$kode_tabungan=$_GET['kode_tabungan'];
$besar_simpanan=$_GET['besar_simpanan'];
$besar_tabungan=$_GET['besar_tabungan'];
include "../config/koneksi.php";
$sqla=mysql_fetch_array(mysql_query("SELECT * from tb_guru where nip='$nip'"));
$sqlb=mysql_fetch_array(mysql_query("SELECT * from tb_tabungan where nip='$nip'"));
$sqlc=mysql_fetch_array(mysql_query("SELECT * from tb_setorguru where nip='$nip'"));
?>
<body onload="window.print()">
<h3><center><img src="../logo2.jpg" width="60" height="60"><br>Bukti Transaksi Setoran Tabungan</center></h3>
<table style="margin-left:50px;">
	<tr>
		<td>NIP</td>
		<td>:</td>
		<td><?php echo $nip; ?></td>
	</tr>
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td><?php echo $sqla['nama_guru']; ?></td>
	</tr>
	<tr>
		<td>Kode Tabungan</td>
		<td>:</td>
		<td><?php echo $sqlb['kode_tabungan']; ?></td>
	</tr>
	<tr>
		<td>Besar simpan</td>
		<td>:</td>
		<td><?php echo  $sqlc['besar_simpana'];  ?></td>
	</tr>
	<tr>
		<td>Totak Tabungan</td>
		<td>:</td>
		<td><?php echo $besar_tabungan; ?></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?php echo date("Y-m-d");?></td>
	</tr>
</table>
<table  border="0" align="center">
		<tr align="center">
			<td width="200" colspan="2">Diketahui oleh,</td>
			<td width="200" colspan="2">Diterima oleh,</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr align="center">
			<td width="200" colspan="2">_ _ _ _ _ _ _ _ _</td>
			<td width="200" colspan="2"><?php session_start(); echo $_SESSION['name'];?></td>
			<td width="200" colspan="2"><?php echo $data['nama_guru'];?></td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
  </table>