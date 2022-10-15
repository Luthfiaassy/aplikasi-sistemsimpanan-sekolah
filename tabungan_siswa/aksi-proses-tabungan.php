<?php
include "../config/koneksi.php";
$kode_t=$_GET['kode_tabungan'];
$kode_a=$_GET['nis'];
$besar=$_GET['besar_ambil'];
$saldo=$_GET['saldo'];
$date=date("Y-m-d");
if($besar>$saldo)
{ ?>
	<script>alert("Maaf Saldo tidak cukup");
window.location="../index.php?pilih=1.3";</script>
<?php }
else
{
	$dfop=mysql_query("INSERT into tb_pengambilansiswa values('','$kode_a','$kode_t','$besar','$date')");
	$siso=$saldo-$besar;
	mysql_query("UPDATE tb_tabungansiswa set besar_tabungan='$siso' where kode_tabungan='$kode_t' and nis='$kode_a'");?>
<script>
	alert("Data Berhasil ditambah");
	var msg = confirm("Apakah Anda akan mencetak Bukti ambil?");
    if(msg==true){
  window.open('buktiambil.php?nis=<?php echo $kode_a; ?>&kode_tabungan=<?php echo $kode_t; ?>&besar_ambil=<?php echo $besar; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100');
  window.location="../index.php?pilih=1.5";
    }
    else{
    window.location="../index.php?pilih=1.5";
    }
	</script>
<?php }
?>