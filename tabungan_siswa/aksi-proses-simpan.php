<?php
	include "../config/koneksi.php";
	$kode_setor		= $_POST['kode_setor'];
	$besar_simpanan		= $_POST['besar_simpanan'];
	$nis		= $_POST['nis'];	
$user_entry			= $_POST['user_entry'];
$tgl_entri			= $_POST['tgl_entri'];
$pros=$_GET['pros'];
	switch($pros){
		case "simpan"	:
							$qtambah=mysql_query("INSERT INTO tb_setorsiswa VALUES('','$besar_simpanan','$nis','$user_entry','$tgl_entri')");
							$sqlbaru=mysql_fetch_array(mysql_query("SELECT besar_tabungan from tb_tabungansiswa where nis='$nis'"));
							$hasil=$sqlbaru['besar_tabungan']+$besar_simpanan;
							$q=mysql_query("UPDATE tb_tabungansiswa SET besar_tabungan ='$hasil' 
					  						WHERE nis='$nis'");?>
							<script type="text/javascript">
								alert("Tabungan berhasil ditambahkan!");
								 var msg = confirm("Apakah Anda akan mencetak Bukti Simpan?");
    if(msg==true){
   window.open('buktisimpan.php?nis=<?php echo $nis; ?>&kode_tabungan=<?php echo $kode_tabungan; ?>&besar_simpanan=<?php echo $besar_simpanan; ?>&besar_tabungan=<?php echo $hasil; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100'); 
    window.location="../index.php?pilih=1.5";
    }
    else{
    window.location="../index.php?pilih=1.5";
    }					
								
							</script>
							<?php
							break;
							}
?>