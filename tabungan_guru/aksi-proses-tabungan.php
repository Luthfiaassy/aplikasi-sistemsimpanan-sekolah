<?php
include "../config/koneksi.php";
$kode_t=$_GET['kode_tabungan'];
$kode_a=$_GET['nip'];
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
	$dfop=mysql_query("INSERT into tb_pengambilan values('','$kode_a','$kode_t','$besar','$date')");
	$siso=$saldo-$besar;
	mysql_query("UPDATE tb_tabungan set besar_tabungan='$siso' where kode_tabungan='$kode_t' and nip='$kode_a'");?>
<script>
	alert("Data Berhasil ditambah");
	var msg = confirm("Apakah Anda akan mencetak Bukti ambil?");
    if(msg==true){
  window.open('buktiambil.php?nip=<?php echo $kode_a; ?>&kode_tabungan=<?php echo $kode_t; ?>&besar_ambil=<?php echo $besar; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100');
  window.location="../index.php?pilih=1.3";
    }
    else{
    window.location="../index.php?pilih=1.3";
    }
	</script>
<?php }
?>