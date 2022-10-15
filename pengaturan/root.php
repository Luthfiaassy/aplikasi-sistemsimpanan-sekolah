<?php
class root
{
	function __construct()
	{
		mysql_connect('localhost','root','');
		mysql_select_db('db_sijam');
	}
	public function tambahpinjam($kode,$kode_jenis_pinjam,$nama_pinjaman,$lama_angsur,$maks_pinjam,$u_entry,$tgl_entri)
	{
		$verida=mysql_query("INSERT INTO tb_jenis_pinjam VALUES('$kode_jenis_pinjam','$nama_pinjaman','$lama_angsur','$maks_pinjam','$u_entry','$tgl_entri')");
		if($verida)
		{
			header("location:../index.php?pilih=4.2");
		}
	}
	public function ubahpinjam($kode,$kode_jenis_pinjam,$nama_pinjaman,$lama_angsur,$maks_pinjam,$u_entry,$tgl_entri)
	{
		$qubah=mysql_query("UPDATE tb_jenis_pinjam SET nama_pinjaman='$nama_pinjaman',lama_angsuran='$lama_angsur',maks_pinjam='$maks_pinjam',u_entry='$u_entry',tgl_entri='$tgl_entri' WHERE kode_jenis_pinjam='$kode_jenis_pinjam'");
			if($qubah){
				header("location:../index.php?pilih=4.2");
			}else{
				echo "Edit Data Gagal!!!";
			}
	}
	public function hapuspinjam($kode,$kode_jenis_pinjam,$nama_pinjaman,$lama_angsur,$maks_pinjam,$u_entry,$tgl_entri)
	{
		$qdelete=mysql_query("DELETE FROM tb_jenis_pinjam WHERE kode_jenis_pinjam='$kode'");
			if($qdelete){
				header("location:../index.php?pilih=4.2");
			}else{
				echo "Hapus Data Gagal!!!!";
			}
		}
	}

?>