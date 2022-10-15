<?php
	include "../config/koneksi.php";
	
	$pros=$_GET['pros'];
	$kode=$_GET['nip'];
	$nip=$_POST['nip'];
	
	$nama_guru=$_POST['nama_guru'];
    
	$alamat=$_POST['alamat'];
	$telp_guru=$_POST['telp_guru'];
		$setoran=$_POST['setoran'];
	$jk_guru=$_POST['jk_guru'];

	$tgl_entri=$_POST['tgl_entri'];
	
switch ($pros){
		case "hapus" :
		$kode=$_GET['nip'];
	
		$tuggak=mysql_num_rows(mysql_query("SELECT * from tb_pinjam where nip='$kode' and status='belum lunas' order by kode_pinjam desc "));
		if($tuggak>0)
		{ ?>
			<script>alert("Maaf guru ini masih ada tunggakan");window.location="../index.php?pilih=1.2";</script>
		<?php }
		else if($tunggak==0)?>
		{<script>
		 $c=confirm("Apakah anda yakin?");
    if($c == true) {
<?php
	mysql_query("DELETE FROM tb_pinjam where nip='$kode'");
			mysql_query("DELETE FROM tb_angsur where nip='$kode'");
			mysql_query("DELETE FROM tb_tabungan where nip='$kode'");
			mysql_query("DELETE FROM tb_pengambilan where nip='$kode'");
mysql_query("DELETE FROM tb_guru WHERE nip='$kode'");?>
alert("Hapus Data Berhasil");
     window.location="../index.php?pilih=1.2";
    }else{

    window.location="../index.php?pilih=1.2";

    }
</script>
			<?php
			break;
		default : break; 
	}
?>
		